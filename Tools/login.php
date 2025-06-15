<?php
session_start();
require_once 'planado_db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: index.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - Planado PH</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="style.css" />

    <style>
    body {
        background: url('images/reg_bg.png') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        padding: 0;
        font-family: 'Fredoka', sans-serif;
        color: #5c4b51;
    }

    .container {
        max-width: 460px;
        margin: 60px auto;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(216, 164, 194, 0.3);
        padding: 40px;
        position: relative;
    }

    h2 {
        text-align: center;
        color: #d279a6;
        font-size: 1.8rem;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: 500;
        color: #6e4e57;
        margin-bottom: 8px;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px 14px;
        border: 2px solid #f5c6de;
        border-radius: 12px;
        font-size: 1rem;
        background-color: #fff0f7;
        transition: all 0.3s ease;
        height: 44px;
    }

    input:focus {
        border-color: #da88ad;
        outline: none;
        background-color: #fff7fa;
    }

    .error {
        color: #e15b7e;
        font-size: 0.88rem;
        margin-bottom: 20px;
        text-align: center;
    }

    button {
        width: 100%;
        background: #e493b3;
        border: none;
        color: white;
        padding: 12px;
        margin-top: 30px;
        border-radius: 12px;
        font-size: 1.1rem;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #cc7da3;
    }

    .register-link {
        text-align: center;
        margin-top: 25px;
    }

    .register-link a {
        color: #c87197;
        text-decoration: none;
        font-weight: 500;
    }

    .register-link a:hover {
        text-decoration: underline;
    }
    </style>
</head>
<body>

<div class="container">
    <h2>Login to Planado PH</h2>

    <?php if (!empty($error)) : ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="login.php" novalidate>
        <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" required />
        </div>

        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" id="password" name="password" required />
        </div>

        <button type="submit">Login</button>
    </form>

    <div class="register-link">
        Don't have an account? <a href="register.php">Register here</a>
    </div>
</div>

</body>
</html>
