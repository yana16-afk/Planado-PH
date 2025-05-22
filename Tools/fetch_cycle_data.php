<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    exit('Unauthorized');
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT last_menstruation_date, ovulation_start, ovulation_end, menstruation_start, menstruation_end FROM user_cycle_data WHERE user_id = ?");
$stmt->execute([$userId]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json');

if ($data) {
    echo json_encode($data);
} else {
    echo json_encode([
        'last_menstruation_date' => null,
        'ovulation_start' => null,
        'ovulation_end' => null,
        'menstruation_start' => null,
        'menstruation_end' => null
    ]);
}
