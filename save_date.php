<?php
require 'db.php';
session_start();

$user_id = $_SESSION['user_id'] ?? 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'] ?? null;

    if (!$date || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        http_response_code(400);
        echo 'Invalid date.';
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO user_menstruation (user_id, last_menstruation_date)
                           VALUES (:user_id, :date)
                           ON DUPLICATE KEY UPDATE last_menstruation_date = :date2");
    $stmt->execute([
        'user_id' => $user_id,
        'date' => $date,
        'date2' => $date
    ]);

    echo 'Saved successfully';
}
