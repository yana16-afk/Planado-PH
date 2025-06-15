<?php
session_start();
require '../planado_db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];
$methodType = (int)($_POST['method'] ?? 0);
$startDate = $_POST['start_date'] ?? null;
$reminderTime = $_POST['reminder_time'] ?? '09:00';

if (!$methodType || !$startDate) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

try {
    $startDateObj = new DateTime($startDate);
    
    $nextReminderDate = clone $startDateObj;
    $nextReminderDate->modify("+{$methodType} days");
    
    $reminders = [];
    $currentDate = clone $nextReminderDate;
    $endDate = new DateTime();
    $endDate->modify('+1 year');
    
    while ($currentDate <= $endDate) {
        $reminders[] = [
            'reminder_date' => $currentDate->format('Y-m-d'),
            'reminder_time' => $reminderTime,
            'method_type' => $methodType,
            'is_completed' => 0
        ];
        
        $currentDate->modify("+{$methodType} days");
        
        if (count($reminders) > 365) {
            break;
        }
    }
    
    $stmt = $pdo->prepare("DELETE FROM contraceptive_reminders WHERE user_id = ?");
    $stmt->execute([$userId]);
    
    $stmt = $pdo->prepare("INSERT INTO contraceptive_reminders 
        (user_id, reminder_date, reminder_time, method_type, is_completed, created_at) 
        VALUES (?, ?, ?, ?, ?, NOW())");
    
    foreach ($reminders as $reminder) {
        $stmt->execute([
            $userId,
            $reminder['reminder_date'],
            $reminder['reminder_time'], 
            $reminder['method_type'],
            $reminder['is_completed']
        ]);
    }
    
    $stmt = $pdo->prepare("INSERT INTO user_contraceptive_settings 
        (user_id, method_type, last_taken_date, reminder_time, created_at) 
        VALUES (?, ?, ?, ?, NOW())
        ON DUPLICATE KEY UPDATE 
        method_type = VALUES(method_type),
        last_taken_date = VALUES(last_taken_date),
        reminder_time = VALUES(reminder_time),
        updated_at = NOW()");
    
    $stmt->execute([$userId, $methodType, $startDate, $reminderTime]);
    
    echo json_encode([
        'success' => true,
        'data' => [
            'method_type' => $methodType,
            'next_reminder_date' => $nextReminderDate->format('Y-m-d'),
            'reminder_time' => $reminderTime,
            'total_reminders_set' => count($reminders)
        ]
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save reminder: ' . $e->getMessage()]);
}
?>