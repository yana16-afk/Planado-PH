<?php
session_start();
require_once 'planado_db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
$profileImage = !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'default.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Profile - Planado PH</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

<!-- ✅ Styled Header -->
<header class="header">
  <div class="logo">
    <a href="index.php">
      <img src="images/logo.png" class="logo-icon" alt="Planado PH Logo">
    </a>
  </div>
  <nav class="nav">
    <a href="index.php">Home</a>
    <a href="tools.php">Tools</a>
    <a href="resources.php">Resources</a>
    <a href="about.php">About</a>
    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="user-profile.php" class="active"><?= htmlspecialchars($_SESSION['user_name']) ?></a>
      <a href="logout.php" class="sign-out-btn">Sign Out</a>
    <?php else: ?>
      <a href="login.php" class="sign-in-btn">Sign In</a>
    <?php endif; ?>
  </nav>
</header>

<!-- Profile Content -->
<main class="main-content">
  <div class="container" style="max-width: 600px; margin: 60px auto; background: #fff; padding: 2rem; border-radius: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); text-align: center;">
    <?php if ($profileImage): ?>
      <img src="pfp-user/<?= $profileImage ?>" alt="Profile Picture" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #BA90C6; margin-bottom: 1rem;">
    <?php endif; ?>
    <h2 style="color: #66173D; font-size: 2rem;"><?= htmlspecialchars($user['name']) ?></h2>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Age:</strong> <?= htmlspecialchars($user['age']) ?></p>
    <p><strong>Sex:</strong> <?= htmlspecialchars($user['sex']) ?></p>
  </div>
</main>

</body>
</html>
