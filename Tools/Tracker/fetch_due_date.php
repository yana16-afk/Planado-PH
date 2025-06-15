<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not logged in']);
    exit;
}

try {
    require 'db_connection.php'; // make sure this is correct

    $stmt = $pdo->prepare("SELECT due_date FROM due_dates WHERE user_id = ? LIMIT 1");
    $stmt->execute([$_SESSION['user_id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && !empty($row['due_date'])) {
        echo json_encode(['success' => true, 'due_date' => $row['due_date']]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No due date found']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
