<?php
session_start();
require '../planado_db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];
$lastDate = $_POST['last_date'] ?? null;

if (!$lastDate) {
    http_response_code(400);
    echo json_encode(['error' => 'No date provided']);
    exit;
}

try {
    $lastDateObj = new DateTime($lastDate);
    
    $stmt = $pdo->prepare("SELECT cycle_length, menstruation_duration, luteal_phase_length FROM user_cycle_data WHERE user_id = ? ORDER BY updated_at DESC LIMIT 1");
    $stmt->execute([$userId]);
    $existingData = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $stmt = $pdo->prepare("SELECT AVG(cycle_length) as avg_cycle, AVG(menstruation_duration) as avg_duration FROM cycle_history WHERE user_id = ? AND cycle_length IS NOT NULL");
    $stmt->execute([$userId]);
    $historyData = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $cycleLength = 28;
    $menstruationDuration = 5;
    $lutealPhase = 14;
    
    if ($historyData && $historyData['avg_cycle']) {
        $cycleLength = round($historyData['avg_cycle']);
        $menstruationDuration = round($historyData['avg_duration']) ?: 5;
    } elseif ($existingData) {
        $cycleLength = $existingData['cycle_length'] ?: 28;
        $menstruationDuration = $existingData['menstruation_duration'] ?: 5;
        $lutealPhase = $existingData['luteal_phase_length'] ?: 14;
    }
    
    
    // 1. Fertile window: typically 6 days (5 days before ovulation + ovulation day)
    $ovulationDay = $cycleLength - $lutealPhase; // Usually day 14 for 28-day cycle
    
    // Fertile window starts 5 days before ovulation
    $fertileWindowStart = clone $lastDateObj;
    $fertileWindowStart->modify('+' . ($ovulationDay - 5) . ' days');
    
    // Fertile window ends 1 day after ovulation
    $fertileWindowEnd = clone $lastDateObj;
    $fertileWindowEnd->modify('+' . ($ovulationDay + 1) . ' days');
    
    // 2. Ovulation period: typically 2-3 days around ovulation day
    $ovulationStart = clone $lastDateObj;
    $ovulationStart->modify('+' . ($ovulationDay - 1) . ' days');
    
    $ovulationEnd = clone $lastDateObj;
    $ovulationEnd->modify('+' . ($ovulationDay + 1) . ' days');
    
    // 3. Next menstruation period
    $nextMenstruationStart = clone $lastDateObj;
    $nextMenstruationStart->modify("+{$cycleLength} days");
    
    $nextMenstruationEnd = clone $nextMenstruationStart;
    $nextMenstruationEnd->modify("+{$menstruationDuration} days");
    
    $fertileStartStr = $fertileWindowStart->format('Y-m-d');
    $fertileEndStr = $fertileWindowEnd->format('Y-m-d');
    $ovStartStr = $ovulationStart->format('Y-m-d');
    $ovEndStr = $ovulationEnd->format('Y-m-d');
    $menStartStr = $nextMenstruationStart->format('Y-m-d');
    $menEndStr = $nextMenstruationEnd->format('Y-m-d');
    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM user_cycle_data WHERE user_id = ?");
    $stmt->execute([$userId]);
    $exists = $stmt->fetchColumn() > 0;
    
    if ($exists) {
        $stmt = $pdo->prepare("UPDATE user_cycle_data 
            SET last_menstruation_date = ?, 
                cycle_length = ?,
                menstruation_duration = ?,
                luteal_phase_length = ?,
                ovulation_start = ?, 
                ovulation_end = ?, 
                fertile_window_start = ?,
                fertile_window_end = ?,
                menstruation_start = ?, 
                menstruation_end = ?,
                updated_at = CURRENT_TIMESTAMP
            WHERE user_id = ?");
        $stmt->execute([
            $lastDate, $cycleLength, $menstruationDuration, $lutealPhase,
            $ovStartStr, $ovEndStr, $fertileStartStr, $fertileEndStr,
            $menStartStr, $menEndStr, $userId
        ]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO user_cycle_data 
            (user_id, last_menstruation_date, cycle_length, menstruation_duration, luteal_phase_length, 
             ovulation_start, ovulation_end, fertile_window_start, fertile_window_end, 
             menstruation_start, menstruation_end) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $userId, $lastDate, $cycleLength, $menstruationDuration, $lutealPhase,
            $ovStartStr, $ovEndStr, $fertileStartStr, $fertileEndStr,
            $menStartStr, $menEndStr
        ]);
    }
    
    $stmt = $pdo->prepare("INSERT INTO cycle_history (user_id, cycle_start_date, cycle_length, menstruation_duration) 
                          VALUES (?, ?, ?, ?) 
                          ON DUPLICATE KEY UPDATE 
                          cycle_length = VALUES(cycle_length), 
                          menstruation_duration = VALUES(menstruation_duration)");
    $stmt->execute([$userId, $lastDate, $cycleLength, $menstruationDuration]);
    
    echo json_encode([
        'success' => true,
        'data' => [
            'cycle_length' => $cycleLength,
            'fertile_window' => [$fertileStartStr, $fertileEndStr],
            'ovulation' => [$ovStartStr, $ovEndStr],
            'next_period' => [$menStartStr, $menEndStr]
        ]
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to calculate cycle data: ' . $e->getMessage()]);
}
?>