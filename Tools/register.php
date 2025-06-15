
<?php
session_start();
$showWelcome = isset($_GET['welcome']) && $_GET['welcome'] === 'true';

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
    $errors = [];
    // Validate Name
$profile_name = 'profilepic1.png'; // set default fallback

if (!empty($_FILES['profile_picture']['name'])) {
    $profile_name = basename($_FILES['profile_picture']['name']);
    $target_dir = "pfp-user/";
    $imageFileType = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));
    $unique_name = uniqid('pfp_', true) . '.' . $imageFileType;
    $target_file = $target_dir . $unique_name;

    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed)) {
        $errors['profile_picture'] = "Only JPG, PNG, and GIF files are allowed.";
    } else {
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
        $profile_name = $unique_name; // update with actual uploaded file name
    }
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
// Validate Terms & Conditions
if (!$terms_accepted) {
    $errors['terms'] = "You must accept the Terms & Conditions.";
}

// If no errors, insert into database
if (empty($errors)) {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, age, sex) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute([$name, $email, $hashed_password, $age, $sex]);

        if ($result) {
            $_SESSION['success'] = "Registration successful! Welcome to Planado PH!";

            header('Location: login.php?welcome=true');
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
    $imageFileType = strtolower(pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION));
    $unique_name = uniqid('pfp_', true) . '.' . $imageFileType;
    $target_file = $target_dir . $unique_name;


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
    .form-banner {
    text-align: center;
    background: linear-gradient(to right, #fbd8e5, #f8a7cc);
    padding: 30px;
    border-radius: 30px;
    box-shadow: 0 12px 25px rgba(216, 164, 194, 0.3);
    position: relative;
    border: 3px solid #f58fb4;
    max-width: 700px;
    margin: 30px auto;
    animation: glow 2s ease-in-out infinite alternate;
}

.form-banner h1 {
    font-size: 36px;
    font-family: 'Fredoka', sans-serif;
    color: white;
    text-shadow: 2px 3px 8px rgba(0, 0, 0, 0.25);
    font-weight: bold;
    margin: 0;
}

@keyframes glow {
    0% { box-shadow: 0 8px 18px rgba(255, 168, 198, 0.2); }
    100% { box-shadow: 0 12px 24px rgba(255, 168, 198, 0.4); }
}

.profile-upload {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-bottom: 2rem;
    text-align: center;
}

.profile-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
    text-align: center;
}

.profile-preview {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 3px dashed #f5c6de;
    margin-bottom: 0.5rem;
    transition: 0.3s ease;
    background-color: #fff;
    box-shadow: 0 0 8px rgba(216, 164, 194, 0.2);
}

.profile-preview:hover {
    transform: scale(1.05);
    border-color: #da88ad;
}

.profile-preview img {
    width: 100%;
    height: 120%;
    object-fit: cover;
}
#preview-image {
  animation: bounceIn 0.8s ease;
}

@keyframes bounceIn {
  0% { transform: scale(0.8); opacity: 0; }
  80% { transform: scale(1.1); }
  100% { transform: scale(1); opacity: 1; }
}
.upload-text {
    font-size: 0.9rem;
    color: #d279a6;
}

input[type=\"file\"]#profile_picture {
    display: none;
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
input:hover,
select:hover {
    box-shadow: 0 0 6px #f5c6de;
}


input:focus,
select:focus {
    border-color: #da88ad;
    outline: none;
    background-color: #fff7fa;
    box-shadow: 0 0 8px #f5c6de, 0 0 14px #f5c6de;
    transition: box-shadow 0.3s ease-in-out;
}
input::placeholder,
select::placeholder {
  color: #b28a9d;
  font-style: italic;
  font-size: 0.95rem;
  opacity: 0.9;
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

        .popup-error {
    margin-top: 6px;
    font-size: 0.88rem;
    color: #e15b7e;
    background-color: #fff0f7;
    padding: 8px 12px;
    border-left: 4px solid #e15b7e;
    border-radius: 8px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    animation: fadeInPop 0.3s ease-out;
}

@keyframes fadeInPop {
    0% {
        opacity: 0;
        transform: translateY(-6px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.terms-popup {
    position: fixed;
    bottom: 40px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #ffe1ec;
    color: #d6336c;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 500;
    font-size: 1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 9999;
    animation: fadeInPop 0.3s ease-out;
}

@keyframes fadeInPop {
    from {
        opacity: 0;
        transform: translate(-50%, 20px);
    }
    to {
        opacity: 1;
        transform: translate(-50%, 0);
    }
}

.success-popup {
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translateX(-50%);
    background-color: #eafaf1;
    color: #37966f;
    padding: 14px 28px;
    font-size: 1rem;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    z-index: 9999;
    animation: fadeInPop 0.3s ease-out;
    font-weight: 500;
}

.confetti {
    position: fixed;
    top: 0;
    width: 10px;
    height: 10px;
    background: var(--confetti-color);
    border-radius: 50%;
    opacity: 0.8;
    animation: fall linear infinite;
    z-index: 1000;
}

@keyframes fall {
    from { transform: translateY(0) rotate(0deg); }
    to { transform: translateY(100vh) rotate(720deg); }
}

.clear-btn {
    background-color: #fbd8e5;
    color: #7a5c66;
    font-weight: 500;
    padding: 10px;
    border-radius: 12px;
    font-size: 1rem;
    width: 100%;
    border: none;
    margin-top: 12px;
    opacity: 0.85;
    transition: 0.3s ease;
    box-shadow: 0 2px 6px rgba(245, 198, 222, 0.4);
}

.clear-btn:hover {
    background-color: #f5c6de;
    opacity: 1;
    box-shadow: 0 4px 10px rgba(245, 198, 222, 0.6);
}
.blob {
  position: absolute;
  width: 120px;
  height: 120px;
  background: #fce4ec;
  border-radius: 50%;
  opacity: 0.4;
  animation: float 8s ease-in-out infinite;
}

.blob:nth-child(1) {
  top: -40px;
  left: -30px;
}
.blob:nth-child(2) {
  bottom: -40px;
  right: -20px;
}

@keyframes float {
  0% { transform: translateY(0px); }
  50% { transform: translateY(20px); }
  100% { transform: translateY(0px); }
}

.tooltip {
  display: inline-block;
  position: relative;
  color: #d279a6;
  font-weight: bold;
  font-size: 1rem;
  margin-left: 6px;
  cursor: pointer;
  z-index: 2;
}

.tooltip::after {
  content: attr(data-text);
  position: absolute;
  bottom: 130%;
  left: 50%;
  transform: translateX(-50%);
  background-color: #fff0f7;
  color: #6e4e57;
  padding: 8px 12px;
  font-size: 0.88rem;
  white-space: nowrap;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s ease, transform 0.3s ease;
}

.tooltip:hover::after {
  opacity: 1;
  transform: translateX(-50%) translateY(-6px);
}

    </style>
</head>
<body>
    <div class="blob"></div>
<div class="blob"></div>

<div class="form-banner">
    <h1>🌸 Create Your Account 🌸</h1>
</div>
<div class="container">
    <?php if (!empty($errors['general'])): ?>
        <div class="general-error"><?= htmlspecialchars($errors['general']) ?></div>
    <?php endif; ?>
<?php if (isset($_SESSION['registered'])): unset($_SESSION['registered']); ?>
    <div class="success-popup">🎉 Registration successful! Welcome to Planado PH! 🎉</div>
    <script>
        for (let i = 0; i < 60; i++) {
            const confetti = document.createElement('div');
            confetti.classList.add('confetti');
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.animationDuration = (Math.random() * 3 + 2) + 's';
            confetti.style.background = '#' + Math.floor(Math.random()*16777215).toString(16);
            document.body.appendChild(confetti);
            setTimeout(() => confetti.remove(), 5000);
        }
    </script>
<?php endif; ?>

    <form id="registerForm" method="POST" action="register.php" enctype="multipart/form-data">
  
<div class="form-group profile-upload">
    <label for="profile_picture" class="profile-label">
        <div class="profile-preview" id="preview-container">
            <img id="preview-image" src="images/default-pfp.png" alt="Preview">
        </div>
        <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
        <span class="upload-text">Click to upload your profile picture ✨ (optional) </span>
    </label>
    <?php if (!empty($errors['profile_picture'])): ?>
        <div class="error"><?= htmlspecialchars($errors['profile_picture']) ?></div>
    <?php endif; ?>
</div>

        <div class="form-group">
          <label for="name">
  Full Name *
  <span class="tooltip" data-text="Use your real name to help us identify you">ℹ️</span>
</label>
            <input type="text" id="full-name" name="name" value="<?= htmlspecialchars($name) ?>" placeholder="Enter your full name" required />
            <small id="name-error" class="error"></small>
            <?php if (!empty($errors['name'])): ?>
                <div class="error"><?= htmlspecialchars($errors['name']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" placeholder="Enter your valid email" required oninput="validateEmail()" />
<small id="email-message" class="error"></small>
            <?php if (!empty($errors['email'])): ?>
                <div class="error"><?= htmlspecialchars($errors['email']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Password *</label>
            <input type="password" id="password" name="password" placeholder="At least 6 characters" required />
            <small id="password-error" class="error"></small>
            <small id="strength-msg" style="color: #c87197; font-size: 0.88rem;"></small>
            <?php if (!empty($errors['password'])): ?>
                <div class="error"><?= htmlspecialchars($errors['password']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password *</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Re-enter your password" required />
            <small id="password-message" class="error"></small>
            <?php if (!empty($errors['confirm_password'])): ?>
                <div class="error"><?= htmlspecialchars($errors['confirm_password']) ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="age">Age *</label>
            <input type="number" id="age" name="age" min="12" max="120" value="<?= htmlspecialchars($age) ?>" placeholder="Enter your age" required />
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


<div class="terms">
    <label class="terms-label">
        <input type="checkbox" name="terms" value="1" <?= $terms_accepted ? 'checked' : '' ?> />
        I accept the <a href="terms.php" target="_blank">Terms & Conditions</a>
    </label>
</div>

        <button type="submit">✨ Register</button>
        <button type="button" class="clear-btn" onclick="clearForm()">🧼 Clear All</button>


    </form>

    <div class="login-link">
        Already have an account? <a href="login.php">Log in here</a>
    </div>
</div>
<script>
document.getElementById("registerForm").addEventListener("submit", function (e) {
    const termsCheckbox = document.querySelector('input[name="terms"]');
    if (!termsCheckbox.checked) {
        e.preventDefault();

        // Check if a popup already exists
        if (document.querySelector('.terms-popup')) return;

        const popup = document.createElement("div");
        popup.textContent = "You must accept the Terms & Conditions.";
        popup.className = "terms-popup";
        document.body.appendChild(popup);

        setTimeout(() => {
            popup.remove();
        }, 3000);
    }
});

document.getElementById("profile_picture").addEventListener("change", function () {
    const file = this.files[0];
    const previewImage = document.getElementById("preview-image");
    if (file) {
        previewImage.src = URL.createObjectURL(file);
    }
});

// Unified password feedback
document.getElementById("password").addEventListener("input", function () {
    const val = this.value;
    const msg = document.getElementById("strength-msg");

    if (val.length < 6) msg.textContent = "Too short 😟";
    else msg.textContent = "Looks good! 🌟";

    checkPasswordMatch(); // Recheck match
});

document.getElementById("confirm-password").addEventListener("input", checkPasswordMatch);

function checkPasswordMatch() {
    const pass = document.getElementById("password").value;
    const confirm = document.getElementById("confirm-password").value;
    const msg = document.getElementById("password-message");

    if (confirm === "") msg.textContent = "";
    else if (pass !== confirm) {
        msg.textContent = "Passwords do not match! 💔";
        msg.style.color = "red";
    } else {
        msg.textContent = "Passwords match! 🎀";
        msg.style.color = "green";
    }
}


document.getElementById("full-name").addEventListener("input", function () {
    let fullName = this.value;
    let errorMessage = document.getElementById("name-error");

    if (fullName.trim().length < 3) {
        errorMessage.textContent = "⚠️ Full Name must be at least 3 characters long.";
        errorMessage.style.color = "red";
    } else {
        errorMessage.textContent = "";
    }
});

function validateEmail() {
    let emailInput = document.getElementById("email");
    let emailMessage = document.getElementById("email-message");
    let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (emailInput.value === "") {
        emailMessage.textContent = "";
    } else if (!emailPattern.test(emailInput.value)) {
        emailMessage.textContent = "Invalid email address! 🚨";
        emailMessage.style.color = "red";
    } else {
        emailMessage.textContent = "Valid email! ✅";
        emailMessage.style.color = "green";
    }
}
function clearForm() {
    const form = document.getElementById("registerForm");
    form.reset(); // Resets all form fields

    // Manually clear each input
    document.getElementById("full-name").value = "";
    document.getElementById("email").value = "";
    document.getElementById("password").value = "";
    document.getElementById("confirm-password").value = "";
    document.getElementById("age").value = "";
    document.getElementById("sex").value = "";
    document.querySelector('input[name="terms"]').checked = false;

    // Reset the profile image
    const preview = document.getElementById("preview-image");
    if (preview) preview.src = "images/default-pfp.png";

    // Clear validation messages
    const msgIDs = ["name-error", "email-message", "strength-msg", "password-message"];
    msgIDs.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = "";
    });

    // Clear profile picture file input
    const fileInput = document.getElementById("profile_picture");
    if (fileInput) fileInput.value = "";
}

window.onload = function () {
    clearForm();

    // Also clear all error messages manually
    document.querySelectorAll('.error').forEach(el => {
        el.textContent = '';
    });

    // Optional: Reset all <small> validation texts (name-error, password-message, etc.)
    const feedbackIds = [
        'name-error', 'email-message', 'password-error',
        'strength-msg', 'password-message'
    ];
    feedbackIds.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = '';
    });
};




</script>

</body>
</html>