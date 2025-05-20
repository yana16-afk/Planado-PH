<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $age = (int)$_POST['age'];
    $email = trim($_POST['email']);

    if ($name && $age && $email) {
        $stmt = $pdo->prepare("INSERT INTO users (name, age, email) VALUES (?, ?, ?)");
        $stmt->execute([$name, $age, $email]);
        $user_id = $pdo->lastInsertId();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $name;
        $_SESSION['age'] = $age;

        header("Location: calendar.php");
        exit;
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f2f2f2;
        }
        .form-container {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 400px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        input[type="text"], input[type="email"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        input[type="submit"] {
            width: 100%;
            background: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Register</h2>
    <?php if (!empty($error)) echo "<div class='error'>$error</div>"; ?>
    <form method="post">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="number" name="age" placeholder="Your Age" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="submit" value="Start Tracking">
    </form>
</div>
</body>
</html>
