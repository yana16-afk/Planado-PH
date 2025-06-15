<?php
session_start();
require_once '../planado_db.php'; // Use consistent database connection file
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'error' => 'Not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

try {
    // Delete the due date for the current user
    $stmt = $pdo->prepare("DELETE FROM due_dates WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Due date deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => 'No due date found to delete']);
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
?>