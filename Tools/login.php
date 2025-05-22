<?php
session_start();
require 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
      // Login success: save user id in session and redirect to calendar
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['name'];
      header("Location: calendar.php");
      exit;
    } else {
      $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <main>
      <section class="container">
          <h1>Login</h1>
          <?php if ($error) : ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
          <?php endif; ?>
          <form method="POST">
            <fieldset>
              <legend>Account Info</legend>
              <label for="email">Email</label>
              <input type="email" id="email" name="email" required />

              <label for="password">Password</label>
              <input type="password" id="password" name="password" required />
            </fieldset>

            <button type="submit">Login</button>
          </form>

          <p style="text-align:center; margin-top: 1rem;">
            Don't have an account? <a href="register.php">Register here</a>
          </p>
      </section>
    </main>
</body>
</html>
