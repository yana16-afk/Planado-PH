<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$userId = $_SESSION['user_id'];
$lastDate = $_POST['last_date'] ?? null;

if (!$lastDate) {
    http_response_code(400);
    echo json_encode(['error' => 'No date provided']);
    exit;
}

$lastDateObj = new DateTime($lastDate);

$nextMenstruationStart = clone $lastDateObj;
$nextMenstruationStart->modify('+28 days');

$nextMenstruationEnd = clone $nextMenstruationStart;
$nextMenstruationEnd->modify('+5 days');

$ovulationStart = clone $nextMenstruationStart;
$ovulationStart->modify('-14 days');

$ovulationEnd = clone $ovulationStart;
$ovulationEnd->modify('+5 days');

$ovStartStr = $ovulationStart->format('Y-m-d');
$ovEndStr = $ovulationEnd->format('Y-m-d');
$menStartStr = $nextMenstruationStart->format('Y-m-d');
$menEndStr = $nextMenstruationEnd->format('Y-m-d');

$stmt = $pdo->prepare("SELECT COUNT(*) FROM user_cycle_data WHERE user_id = ?");
$stmt->execute([$userId]);
$exists = $stmt->fetchColumn() > 0;

if ($exists) {
    $stmt = $pdo->prepare("UPDATE user_cycle_data SET last_menstruation_date = ?, ovulation_start = ?, ovulation_end = ?, menstruation_start = ?, menstruation_end = ? WHERE user_id = ?");
    $stmt->execute([$lastDate, $ovStartStr, $ovEndStr, $menStartStr, $menEndStr, $userId]);
} else {
    $stmt = $pdo->prepare("INSERT INTO user_cycle_data (user_id, last_menstruation_date, ovulation_start, ovulation_end, menstruation_start, menstruation_end) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$userId, $lastDate, $ovStartStr, $ovEndStr, $menStartStr, $menEndStr]);
}

echo json_encode(['success' => true]);
