<?php
session_start();
require '../planado_db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update cycle settings
    $cycleLength = (int)($_POST['cycle_length'] ?? 28);
    $menstruationDuration = (int)($_POST['menstruation_duration'] ?? 5);
    $lutealPhase = (int)($_POST['luteal_phase_length'] ?? 14);
    
    // Validate inputs
    if ($cycleLength < 21 || $cycleLength > 35) {
        http_response_code(400);
        echo json_encode(['error' => 'Cycle length must be between 21 and 35 days']);
        exit;
    }
    
    if ($menstruationDuration < 3 || $menstruationDuration > 7) {
        http_response_code(400);
        echo json_encode(['error' => 'Menstruation duration must be between 3 and 7 days']);
        exit;
    }
    
    if ($lutealPhase < 10 || $lutealPhase > 16) {
        http_response_code(400);
        echo json_encode(['error' => 'Luteal phase must be between 10 and 16 days']);
        exit;
    }
    
    try {
        // Update existing record
        $stmt = $pdo->prepare("UPDATE user_cycle_data 
            SET cycle_length = ?, 
                menstruation_duration = ?, 
                luteal_phase_length = ?,
                updated_at = CURRENT_TIMESTAMP
            WHERE user_id = ?");
        $stmt->execute([$cycleLength, $menstruationDuration, $lutealPhase, $userId]);
        
        // If no rows were affected, create new record
        if ($stmt->rowCount() == 0) {
            $stmt = $pdo->prepare("INSERT INTO user_cycle_data 
                (user_id, cycle_length, menstruation_duration, luteal_phase_length, last_menstruation_date) 
                VALUES (?, ?, ?, ?, CURDATE())");
            $stmt->execute([$userId, $cycleLength, $menstruationDuration, $lutealPhase]);
        }
        
        echo json_encode(['success' => true, 'message' => 'Settings updated successfully']);
        
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to update settings: ' . $e->getMessage()]);
    }
    
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get current settings
    try {
        $stmt = $pdo->prepare("SELECT cycle_length, menstruation_duration, luteal_phase_length 
            FROM user_cycle_data WHERE user_id = ? ORDER BY updated_at DESC LIMIT 1");
        $stmt->execute([$userId]);
        $settings = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($settings) {
            echo json_encode([
                'cycle_length' => (int)$settings['cycle_length'],
                'menstruation_duration' => (int)$settings['menstruation_duration'],
                'luteal_phase_length' => (int)$settings['luteal_phase_length']
            ]);
        } else {
            echo json_encode([
                'cycle_length' => 28,
                'menstruation_duration' => 5,
                'luteal_phase_length' => 14
            ]);
        }
        
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch settings: ' . $e->getMessage()]);
    }
}
?>