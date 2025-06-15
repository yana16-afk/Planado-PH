<?php
session_start();
require_once 'planado_db.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit;
}

$user_name = $_SESSION['user_name'];
$user_initials = $_SESSION['user_initials'] ?? strtoupper(substr($user_name, 0, 2));

// Fetch user
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
$profileImage = !empty($user['profile_picture']) ? htmlspecialchars($user['profile_picture']) : 'profilepic1.png';


$updated = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $age = (int) $_POST['age'];
    $sex = $_POST['sex'];

    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ?, age = ?, sex = ? WHERE id = ?");
    $updated = $stmt->execute([$name, $email, $age, $sex, $_SESSION['user_id']]);
    $_SESSION['user_name'] = $name;

    header("Location: user-profile.php?success=" . ($updated ? "1" : "0"));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Profile - Planado PH</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;600&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <style>
    .main-content {
      padding: 2rem 4rem;
    }
    .profile-container {
      max-width: 600px;
      margin: 40px auto;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(216, 164, 194, 0.2);
      padding: 2rem;
      position: relative;
    }
    .profile-pic {
      width: 140px;
      height: 140px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #BA90C6;
      margin-bottom: 1rem;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
    .form-group label {
      display: block;
      margin-bottom: 6px;
      color: #66173D;
      font-weight: 500;
    }
    .form-group input,
    .form-group select {
      width: 100%;
      padding: 10px 14px;
      border: 2px solid #f5c6de;
      border-radius: 12px;
      font-size: 1rem;
      background-color: #fff0f7;
    }
    .submit-btn {
      background: #BA90C6;
      color: #fff;
      border: none;
      border-radius: 25px;
      padding: 12px 24px;
      font-weight: bold;
      font-size: 1rem;
      cursor: pointer;
      margin-top: 1rem;
      display: none;
    }
    .submit-btn:hover {
      background: #9e6ca9;
    }


.edit-btn {
  position: absolute;
  top: 20px;
  right: 20px;
  background-color: #f5c6de;
  color: #66173D;
  border: none;
  border-radius: 20px;
  padding: 10px 18px;
  font-weight: bold;
  font-size: 0.95rem;
  cursor: pointer;
  transition: background 0.3s ease, transform 0.2s;
  box-shadow: 0 4px 10px rgba(216, 164, 194, 0.3);
}

.edit-btn:hover {
  background-color: #eba7c8;
  transform: scale(1.05);
}


.cancel-btn {
  background: #f5c6de;
  color: #66173D;
  border: none;
  border-radius: 25px;
  padding: 12px 24px;
  font-weight: bold;
  font-size: 1rem;
  cursor: pointer;
  margin-top: 1rem;
  margin-left: 10px;
  display: none;
}

.cancel-btn:hover {
  background: #e2a4c1;
}
.delete-btn {
  background-color: #ff6b81;
  color: white;
  font-weight: bold;
  border: none;
  padding: 12px 24px;
  border-radius: 25px;
  cursor: pointer;
  margin-top: 1rem;
  margin-left: 10px;
  transition: background 0.3s ease;
}

.delete-btn:hover {
  background-color: #e84156;
}


.profile-container {
  background: linear-gradient(to bottom right, #fff0f7, #fce4ec);
  border: 3px solid #f58fb4;
  padding: 3rem 2.5rem;
}

    .popup {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      background: #fff;
      padding: 1rem 2rem;
      border-radius: 15px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.1);
      z-index: 999;
      font-weight: bold;
      animation: floatIn 0.3s ease;
    }
    .popup.success { background-color: #d4edda; color: #256029; }
    .popup.error { background-color: #f8d7da; color: #721c24; }

    @keyframes floatIn {
      from { opacity: 0; transform: translateY(-20px) translateX(-50%); }
      to { opacity: 1; transform: translateY(0) translateX(-50%); }
    }

    /* Fix overlapping dropdown */
    .nav { z-index: 10; position: relative; }
    body {
  background: url('images/userprof-bg.png') no-repeat center center fixed;
  background-size: cover;
}
  </style>
</head>
<body>

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

    <div class="user-profile">
      <div class="user-avatar"><?= htmlspecialchars($user_initials) ?></div>
      <div class="user-info">
        <div class="user-name"><?= htmlspecialchars($user_name) ?></div>
      </div>
      <div class="dropdown-arrow">▼</div>
      <div class="user-dropdown">
        <a href="user-profile.php">My Profile</a>
        <a href="logout.php">Sign Out</a>
      </div>
    </div>
  </nav>
</header>

<main class="main-content">
  <?php if (isset($_GET['success'])): ?>
    <div class="popup <?= $_GET['success'] === '1' ? 'success' : 'error' ?>">
      <?= $_GET['success'] === '1' ? 'Profile updated successfully!' : 'Failed to update profile.' ?>
    </div>
  <?php endif; ?>

  <div class="profile-container">
    <form method="POST">
      <button type="button" class="edit-btn" onclick="toggleEdit()">
  ✏️ Edit Profile
</button>


      <img src="pfp-user/<?= $profileImage ?>" class="profile-pic" alt="Profile Picture" />

      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']) ?>" readonly>
      </div>

      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>
      </div>

      <div class="form-group">
        <label for="age">Age</label>
        <input type="number" name="age" id="age" value="<?= htmlspecialchars($user['age']) ?>" readonly>
      </div>

      <div class="form-group">
        <label for="sex">Sex</label>
        <select name="sex" id="sex" disabled>
          <option value="Female" <?= $user['sex'] === 'Female' ? 'selected' : '' ?>>Female</option>
          <option value="Male" <?= $user['sex'] === 'Male' ? 'selected' : '' ?>>Male</option>
          <option value="Other" <?= $user['sex'] === 'Other' ? 'selected' : '' ?>>Other</option>
          <option value="Prefer not to say" <?= $user['sex'] === 'Prefer not to say' ? 'selected' : '' ?>>Prefer not to say</option>
        </select>
      </div>

      <div class="form-buttons">
  <button type="submit" class="submit-btn">Save Changes</button>
  <button type="button" class="cancel-btn" onclick="cancelEdit()">Cancel</button>
  <button type="button" class="delete-btn" onclick="confirmDelete()">🗑️ Delete Account</button>
</div>

    </form>
  </div>
</main>

<script>
function toggleEdit() {
  const form = document.querySelector('form');
  const inputs = form.querySelectorAll('input, select');
  const submitBtn = form.querySelector('.submit-btn');
  const cancelBtn = form.querySelector('.cancel-btn');

  // Enable input fields
  inputs.forEach(el => el.removeAttribute('readonly'));
  form.querySelector('#sex').removeAttribute('disabled');

  // Show Save and Cancel buttons
  submitBtn.style.display = 'inline-block';
  cancelBtn.style.display = 'inline-block';
}

function cancelEdit() {
  const form = document.querySelector('form');
  const inputs = form.querySelectorAll('input, select');
  const submitBtn = form.querySelector('.submit-btn');
  const cancelBtn = form.querySelector('.cancel-btn');

  inputs.forEach(el => el.setAttribute('readonly', true));
  form.querySelector('#sex').setAttribute('disabled', true);

  submitBtn.style.display = 'none';
  cancelBtn.style.display = 'none';

  window.location.reload();
}

setTimeout(() => {
  const popup = document.querySelector('.popup');
  if (popup) popup.style.display = 'none';
}, 3000);

function confirmDelete() {
  if (confirm("Are you sure you want to permanently delete your account? This cannot be undone.")) {
    window.location.href = "delete-account.php";
  }
}

</script>




</body>
</html>
