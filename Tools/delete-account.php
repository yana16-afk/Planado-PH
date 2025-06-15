<?php
session_start();
require_once 'planado_db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];

// Delete user
$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$userId]);

// Clear session and redirect
session_destroy();
header("Location: index.php?account_deleted=1");
exit;
?>
