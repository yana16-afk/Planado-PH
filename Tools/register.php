<?php
require 'planado_db.php';  

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['fullname']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $confirm = $_POST['confirm_password'];
  $gender = $_POST['gender'] ?? '';

  if ($password !== $confirm) {
    $error = "Passwords do not match.";
  } else {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
      $error = "Email already registered.";
    } else {

      $hashed = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $pdo->prepare("INSERT INTO users (name, email, password, gender) VALUES (?, ?, ?, ?)");
      $stmt->execute([$name, $email, $hashed, $gender]);
      header("Location: index.php");
      exit;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <main>
    <section class="container">
      <h1>Register</h1>
      <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
      <form method="POST" enctype="multipart/form-data" novalidate>
        <fieldset>
          <legend>Personal Info</legend>
          <label for="fullname">Full Name</label>
          <input type="text" id="fullname" name="fullname" required value="<?= isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : '' ?>">

          <label for="email">Email</label>
          <input type="email" id="email" name="email" required value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">

          <label for="password">Password</label>
          <input type="password" id="password" name="password" minlength="8" required>

          <label for="confirm_password">Confirm Password</label>
          <input type="password" id="confirm_password" name="confirm_password" minlength="8" required>
        </fieldset>

        <fieldset>
          <legend>Profile</legend>
          <label for="profile_picture">Profile Picture</label>
          <input type="file" id="profile_picture" name="profile_picture" accept=".jpg,.jpeg,.png">

          <label>Gender</label>
          <div>
            <input type="radio" id="gender_male" name="gender" value="Male" <?= (isset($_POST['gender']) && $_POST['gender'] === 'Male') ? 'checked' : '' ?> required>
            <label for="gender_male">Male</label>

            <input type="radio" id="gender_female" name="gender" value="Female" <?= (isset($_POST['gender']) && $_POST['gender'] === 'Female') ? 'checked' : '' ?>>
            <label for="gender_female">Female</label>

            <input type="radio" id="gender_other" name="gender" value="Other" <?= (isset($_POST['gender']) && $_POST['gender'] === 'Other') ? 'checked' : '' ?>>
            <label for="gender_other">Other</label>
          </div>
        </fieldset>

        <fieldset>
          <legend>Terms</legend>
          <label>
            <input type="checkbox" name="terms" required <?= isset($_POST['terms']) ? 'checked' : '' ?>>
            I accept the <a href="#">Terms & Conditions</a>
          </label>
        </fieldset>

        <button type="submit">Register</button>
      </form>
    </section>
  </main>
</body>
</html>
