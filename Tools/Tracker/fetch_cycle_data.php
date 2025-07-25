<?php
session_start();
require '../planado_db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];

try {
    $stmt = $pdo->prepare("SELECT 
        last_menstruation_date, 
        cycle_length,
        menstruation_duration,
        luteal_phase_length,
        ovulation_start, 
        ovulation_end, 
        fertile_window_start,
        fertile_window_end,
        menstruation_start, 
        menstruation_end 
        FROM user_cycle_data 
        WHERE user_id = ? 
        ORDER BY updated_at DESC 
        LIMIT 1");
    $stmt->execute([$userId]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $stmt = $pdo->prepare("SELECT 
        AVG(cycle_length) as avg_cycle_length,
        MIN(cycle_length) as min_cycle_length,
        MAX(cycle_length) as max_cycle_length,
        AVG(menstruation_duration) as avg_period_length,
        COUNT(*) as total_cycles
        FROM cycle_history 
        WHERE user_id = ? 
        AND cycle_length IS NOT NULL");
    $stmt->execute([$userId]);
    $stats = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $pdo->prepare("SELECT 
        reminder_date, 
        reminder_time, 
        method_type, 
        is_completed 
        FROM contraceptive_reminders 
        WHERE user_id = ? 
        AND reminder_date >= CURDATE() 
        AND reminder_date <= DATE_ADD(CURDATE(), INTERVAL 6 MONTH)
        ORDER BY reminder_date ASC");
    $stmt->execute([$userId]);
    $reminders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($data) {
        $response = [
            'last_menstruation_date' => $data['last_menstruation_date'],
            'cycle_length' => (int)$data['cycle_length'],
            'menstruation_duration' => (int)$data['menstruation_duration'],
            'luteal_phase_length' => (int)$data['luteal_phase_length'],
            'ovulation_start' => $data['ovulation_start'],
            'ovulation_end' => $data['ovulation_end'],
            'fertile_window_start' => $data['fertile_window_start'],
            'fertile_window_end' => $data['fertile_window_end'],
            'menstruation_start' => $data['menstruation_start'],
            'menstruation_end' => $data['menstruation_end'],
            'statistics' => [
                'avg_cycle_length' => $stats['avg_cycle_length'] ? round($stats['avg_cycle_length'], 1) : null,
                'cycle_range' => $stats['min_cycle_length'] && $stats['max_cycle_length'] ? 
                    [$stats['min_cycle_length'], $stats['max_cycle_length']] : null,
                'avg_period_length' => $stats['avg_period_length'] ? round($stats['avg_period_length'], 1) : null,
                'total_cycles_tracked' => (int)$stats['total_cycles']
            ],
            'reminders' => $reminders
        ];
    } else {
        $response = [
            'last_menstruation_date' => null,
            'cycle_length' => 28,
            'menstruation_duration' => 5,
            'luteal_phase_length' => 14,
            'ovulation_start' => null,
            'ovulation_end' => null,
            'fertile_window_start' => null,
            'fertile_window_end' => null,
            'menstruation_start' => null,
            'menstruation_end' => null,
            'statistics' => [
                'avg_cycle_length' => null,
                'cycle_range' => null,
                'avg_period_length' => null,
                'total_cycles_tracked' => 0
            ],
            'reminders' => $reminders
        ];
    }
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch cycle data: ' . $e->getMessage()]);
}
?>