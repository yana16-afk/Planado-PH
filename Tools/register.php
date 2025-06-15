

<?php
session_start();
require_once 'planado_db.php';

// Initialize variables for error messages and form values
$errors = [];
$name = $email = $age = $sex = '';
$terms_accepted = isset($_POST['terms']) ? true : false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $age = (int) $_POST['age'];
    $sex = $_POST['sex'] ?? '';

    // Validate Name
    if (empty($name)) {
        $errors['name'] = "Please enter your full name.";
    } elseif (strlen($name) < 3) {
        $errors['name'] = "Name should be at least 3 characters.";
    }

    // Validate Email
    if (empty($email)) {
        $errors['email'] = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email address.";
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $errors['email'] = "Email is already registered.";
        }
    }

    // Validate Password
    if (empty($password)) {
        $errors['password'] = "Please enter a password.";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    }

    // Confirm Password
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    // Validate Age
    if ($age <= 0 || $age > 120) {
        $errors['age'] = "Please enter a valid age.";
    }

    // Validate Sex
    $valid_sex = ['Female', 'Male', 'Other', 'Prefer not to say'];
    if (!in_array($sex, $valid_sex)) {
        $errors['sex'] = "Please select your sex.";
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, age, sex) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute([$name, $email, $hashed_password, $age, $sex]);

        if ($result) {
            $_SESSION['success'] = "Registration successful! You can now log in.";
            header('Location: login.php');
            exit;
        } else {
            $errors['general'] = "Registration failed. Please try again.";
        }
    }
}
if (!$terms_accepted) {
    $errors['terms'] = "You must accept the Terms & Conditions.";
}

$profile_name = '';
if (!empty($_FILES['profile_picture']['name'])) {
    $profile_name = basename($_FILES['profile_picture']['name']);
    $target_dir = "pfp-user/";
    $unique_name = uniqid('pfp_', true) . '.' . $imageFileType;
    $target_file = $target_dir . $unique_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed)) {
        $errors['profile_picture'] = "Only JPG, PNG, and GIF files are allowed.";
    } else {
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // just in case
        }
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register - Planado PH</title>
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500&display=swap" rel="stylesheet"> 

    <style>
    * {
        box-sizing: border-box;
        font-family: 'Fredoka', sans-serif;
    }

    body {
        background: url('images/reg_bg.png') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        padding: 0;
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

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="number"],
    select {
        width: 100%;
        padding: 10px 14px;
        border: 2px solid #f5c6de;
        border-radius: 12px;
        font-size: 1rem;
        background-color: #fff0f7;
        transition: all 0.3s ease;
        height: 44px;
    }

    input:focus,
    select:focus {
        border-color: #da88ad;
        outline: none;
        background-color: #fff7fa;
    }

    .error {
        color: #e15b7e;
        font-size: 0.88rem;
        margin-top: 5px;
    }

    .general-error,
    .success-message {
        text-align: center;
        font-weight: 500;
        margin-bottom: 20px;
    }

    .general-error {
        color: #e15b7e;
    }

    .success-message {
        color: #62b27f;
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

    .login-link {
        text-align: center;
        margin-top: 25px;
    }

    .login-link a {
        color: #c87197;
        text-decoration: none;
        font-weight: 500;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

        /* Terms & Conditions */

        .terms {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
            text-align: center;
          }
          
          .terms-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: #444;
          }
          
          .terms-label a {
            color: #ff69b4; /* pastel pink! */
            text-decoration: none;
          }
          
          .terms-label a:hover {
            text-decoration: underline;
          }
          
        .terms input {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .terms a {
            color: #d63384;
            font-weight: bold;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>Create Your Account</h2>

    <?php if (!empty($errors['general'])): ?>
        <div class="general-error"><?= htmlspecialchars($errors['general']) ?></div>
    <?php endif; ?>

<form method="POST" action="register.php" enctype="multipart/form-data" novalidate>
        <div class="form-group">
            <label for="name">Full Name *</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required />
            <?php if (!empty($errors['name'])): ?>
                <div class="error"><?= htmlspecialchars($errors['name']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required />
            <?php if (!empty($errors['email'])): ?>
                <div class="error"><?= htmlspecialchars($errors['email']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Password (min 6 characters) *</label>
            <input type="password" id="password" name="password" required />
            <?php if (!empty($errors['password'])): ?>
                <div class="error"><?= htmlspecialchars($errors['password']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password *</label>
            <input type="password" id="confirm_password" name="confirm_password" required />
            <?php if (!empty($errors['confirm_password'])): ?>
                <div class="error"><?= htmlspecialchars($errors['confirm_password']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="age">Age *</label>
            <input type="number" id="age" name="age" min="12" max="120" value="<?= htmlspecialchars($age) ?>" required />
            <?php if (!empty($errors['age'])): ?>
                <div class="error"><?= htmlspecialchars($errors['age']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="sex">Sex *</label>
            <select id="sex" name="sex" required>
                <option value="" disabled <?= $sex === '' ? 'selected' : '' ?>>Select your sex</option>
                <option value="Female" <?= $sex === 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Male" <?= $sex === 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Other" <?= $sex === 'Other' ? 'selected' : '' ?>>Other</option>
                <option value="Prefer not to say" <?= $sex === 'Prefer not to say' ? 'selected' : '' ?>>Prefer not to say</option>
            </select>
            <?php if (!empty($errors['sex'])): ?>
                <div class="error"><?= htmlspecialchars($errors['sex']) ?></div>
            <?php endif; ?>
        </div>
<div class="form-group">
    <label for="profile_picture">Profile Picture</label>
    <input type="file" id="profile_picture" name="profile_picture" accept="image/*" />
    <?php if (!empty($errors['profile_picture'])): ?>
        <div class="error"><?= htmlspecialchars($errors['profile_picture']) ?></div>
    <?php endif; ?>
</div>

<div class="terms">
    <label class="terms-label">
        <input type="checkbox" name="terms" value="1" <?= $terms_accepted ? 'checked' : '' ?> />
        I accept the <a href="terms.php" target="_blank">Terms & Conditions</a>
    </label>
</div>
<?php if (!empty($errors['terms'])): ?>
    <div class="error" style="text-align: center;"><?= htmlspecialchars($errors['terms']) ?></div>
<?php endif; ?>

        <button type="submit">Register</button>
    </form>

    <div class="login-link">
        Already have an account? <a href="login.php">Log in here</a>
    </div>
</div>

</body>
</html>
