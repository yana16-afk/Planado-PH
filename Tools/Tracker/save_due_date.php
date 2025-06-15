<?php
session_start();
header('Content-Type: application/json');
require '../planado_db.php'; 

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];
$dueDate = $_POST['due_date'] ?? null;

if (!$dueDate) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Missing due date']);
    exit;
}

try {
    // Check if a due date already exists for the user
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM due_dates WHERE user_id = ?");
    $stmt->execute([$userId]);
    $exists = $stmt->fetchColumn() > 0;

    if ($exists) {
        // Update the existing due date
        $stmt = $pdo->prepare("UPDATE due_dates 
                               SET due_date = ?, created_at = CURRENT_TIMESTAMP 
                               WHERE user_id = ?");
        $stmt->execute([$dueDate, $userId]);
    } else {
        // Insert a new due date
        $stmt = $pdo->prepare("INSERT INTO due_dates (user_id, due_date) VALUES (?, ?)");
        $stmt->execute([$userId, $dueDate]);
    }

    echo json_encode([
        'success' => true,
        'message' => 'Due date saved successfully',
        'data' => [
            'due_date' => $dueDate
        ]
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}
