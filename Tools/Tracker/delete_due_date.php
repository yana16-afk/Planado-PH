<?php
session_start();
require_once 'db.php'; // or whatever your database config file is named
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

try {
    // Use your existing $pdo connection
    
    // Delete the due date for the current user
    $stmt = $pdo->prepare("DELETE FROM due_dates WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    
    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Due date deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'error' => 'No due date found to delete']);
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false, 
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
?>