<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Not logged in']);
    exit;
}

try {
    // Use the same database connection file as your other scripts
    require_once '../planado_db.php'; // or use 'db.php' if that's your main connection file

    $stmt = $pdo->prepare("SELECT due_date FROM due_dates WHERE user_id = ? LIMIT 1");
    $stmt->execute([$_SESSION['user_id']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row && !empty($row['due_date'])) {
        echo json_encode(['success' => true, 'due_date' => $row['due_date']]);
    } else {
        echo json_encode(['success' => false, 'error' => 'No due date found']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Database error: ' . $e->getMessage()]);
}
?>