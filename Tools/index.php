<?php
session_start();
$successMessage = '';
$showWelcome = isset($_GET['welcome']) && $_GET['welcome'] === 'true';
require_once 'planado_db.php';
// Check if the user has just registered and is being redirected to the dashboard
if (isset($_SESSION['user_id']) && isset($_GET['welcome']) && $_GET['welcome'] === 'true') {
    $showWelcome = true;
    unset($_SESSION['user_id']); // Clear the session variable to avoid showing welcome again
} else {
    $showWelcome = false;
}
if (isset($_SESSION['success'])) {
    $successMessage = $_SESSION['success'];
    unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planado PH</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php if ($showWelcome): ?>
<div id="welcome-overlay">
    <div class="welcome-card">
        <h1>🎉 Welcome to Planado PH!</h1>
        <p>We're excited to have you on board! Redirecting to your dashboard...</p>
    </div>
</div>
<script>
    setTimeout(() => {
        document.getElementById("welcome-overlay").style.display = "none";
    }, 4000);
</script>
<?php endif; ?>

    <?php if (!empty($successMessage)) : ?>
    <div class="success-popup"><?= htmlspecialchars($successMessage) ?></div>
<?php endif; ?>

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

  <?php if (isset($_SESSION['user_id'])): 
    $user_name = $_SESSION['user_name'];
    $initials = strtoupper(substr($user_name, 0, 2));
  ?>
    <div class="user-profile">
      <div class="user-avatar"><?= htmlspecialchars($initials) ?></div>
      <div class="user-name"><?= htmlspecialchars($user_name) ?></div>
      <div class="dropdown-arrow">▼</div>
      <div class="user-dropdown">
        <a href="user-profile.php">My Profile</a>
        <a href="logout.php">Sign Out</a>
      </div>
    </div>
  <?php else: ?>
    <a href="login.php" class="sign-in-btn">Sign In</a>
  <?php endif; ?>
</nav>


    </header>

    <main class="main-content">
        <section class="banner">
            <div class="banner-content">
                <div class="banner-text">
                    <h1>Take control of your reproductive health</h1>
                    <p>Access reliable information and tools for planning and reproductive health</p>
                    <div class="banner-buttons">
                        <a href="register.php" class="btn-primary">Start Tracking</a>
                        <a href="resources.php" class="btn-secondary">Explore Resources</a>
                    </div>
                </div>
                <div class="banner-image">
                    <img src="images/woman-reading.png" alt="Woman" class="woman-image">
                    <div class="animated-element">
                        <img src="images/animated.png" alt="Animated Element" class="animated-image">
                    </div>
                </div>
            </div>
        </section>

        <section class="featured-section">
            <h2 class="section-title">Featured Content</h2>
            <div class="featured-grid">
                <div class="featured-card">
                    <div class="card-image">
                        <img src="images/syringe.png" alt="Syringe and Vial">
                    </div>
                    <div class="card-content">
                        <p>Explore comprehensive information about safe and effective birth control options. From hormonal methods to barrier methods and permanent solutions, discover the right contraceptive choice for your health needs.</p>
                        <a href="contraceptives.php" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="featured-card">
                    <div class="card-image">
                        <img src="images/pregnancytest.png" alt="Pregnancy Test">
                    </div>
                    <div class="card-content">
                        <p>Start your pregnancy journey right. Learn preconception preparation, recognize early pregnancy signs, and understand what happens during each trimester with our comprehensive guide.</p>
                        <a href="pregnancy.php" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="featured-card">
                    <div class="card-image">
                        <img src="images/reproductive.png" alt="Reproductive System">
                    </div>
                    <div class="card-content">
                        <p>Understand your reproductive system and fertility cycles. Learn about ovulation tracking, menstrual health, and how to make informed decisions about family planning and reproductive wellness.</p>
                        <a href="reproductive.php" class="read-more">Read More</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="tools-section">
            <h2 class="section-title">Quick Tools</h2>
            <div class="tools-grid">
                <div class="tool-card">
                    <div class="tool-icon">
                        <img src="images/calendar.png" alt="Calendar Icon">
                    </div>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="Tracker/ovulation-tracker.php" class="tool-button">
                            Ovulation Tracker
                        </a>
                    <?php else: ?>
                        <a href="login.php?redirect=Tracker/ovulation-tracker.php" class="tool-button">
                            Ovulation Tracker
                        </a>
                    <?php endif; ?>
                </div>
                <div class="tool-card">
                    <div class="tool-icon">
                        <img src="images/pills.png" alt="Pills Icon">
                    </div>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="Tracker/reminder.php" class="tool-button">
                            Reminder
                        </a>
                    <?php else: ?>
                        <a href="login.php?redirect=Tracker/reminder.php" class="tool-button">
                            Reminder
                        </a>
                    <?php endif; ?>
                </div>
                <div class="tool-card">
                    <div class="tool-icon">
                        <img src="images/baby.png" alt="Baby Icon">
                    </div>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="Tracker/due-date-calculator.php" class="tool-button">
                            Due Date Calculator
                        </a>
                    <?php else: ?>
                        <a href="login.php?redirect=Tracker/due-date-calculator.php" class="tool-button">
                            Due Date Calculator
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <footer class="modern-footer">
  <div class="footer-main">
    <!-- Branding -->
    <div class="footer-column footer-logo-column">
      <img src="images/whitelogo.png" alt="Planado PH Logo" class="footer-logo">
      <p class="footer-tagline">Kapag sigurado, Gawing PLANADO!</p>
    </div>

    <!-- Tools Links -->
    <div class="footer-column">
      <h4>Tools</h4>
      <ul>
        <li>
          <?php if (isset($_SESSION['user_id'])): ?>
            <a href="Tracker/ovulation-tracker.php">Ovulation Tracker</a>
          <?php else: ?>
            <a href="login.php?redirect=Tracker/ovulation-tracker.php">Ovulation Tracker</a>
          <?php endif; ?>
        </li>
        <li>
          <?php if (isset($_SESSION['user_id'])): ?>
            <a href="Tracker/reminder.php">Reminder</a>
          <?php else: ?>
            <a href="login.php?redirect=Tracker/reminder.php">Reminder</a>
          <?php endif; ?>
        </li>
        <li>
          <?php if (isset($_SESSION['user_id'])): ?>
            <a href="Tracker/due-date-calculator.php">Due Date Calculator</a>
          <?php else: ?>
            <a href="login.php?redirect=Tracker/due-date-calculator.php">Due Date Calculator</a>
          <?php endif; ?>
        </li>
      </ul>
    </div>

    <!-- About Links -->
    <div class="footer-column">
      <h4>About</h4>
      <ul>
        <li><a href="about.php">Our Mission</a></li>
        <li><a href="resources.php">Resources</a></li>
      </ul>
    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <p>&copy; 2025 Planado PH. All rights reserved.</p>
  </div>
</footer>

<script>
    const popup = document.querySelector('.success-popup');
    if (popup) {
        setTimeout(() => {
            popup.remove();
        }, 3000);
    }
</script>



</body>
</html>