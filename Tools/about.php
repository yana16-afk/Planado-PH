<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
        <section class="about-intro">
            <div class="about-intro-content">
                <div class="about-intro-text">
                    <h1>About Planado PH</h1>
                    <p>Planado PH is a digital platform dedicated to empowering Filipinos with accessible, accurate, and culturally sensitive information on family planning and reproductive health. We believe that everyone has the right to make informed decisions about their bodies and futures — and that starts with access to the right knowledge.</p>
                </div>
                <div class="about-intro-image">
                    <img src="images/woman-reading.png" 
                         alt="Woman" 
                         class="woman-image">
                    
                    <div class="animated-element">
                        <img src="images/animated.png"
                             alt="Animated Element" 
                             class="animated-image">
                    </div>
                </div>
            </div>
        </section>

        <section class="mission-vision">
            <div class="mission-card">
                <h2>Our Mission</h2>
                <p>To empower individuals and families in the Philippines by providing free, reliable, and culturally relevant reproductive health information and tools that support informed and responsible decision-making.</p>
            </div>
            <div class="vision-card">
                <h2>Our Vision</h2>
                <p>A future where every Filipino — regardless of age, gender, or socio-economic status — has the knowledge and resources to take control of their reproductive health, leading to healthier communities and more equitable opportunities.</p>
            </div>
        </section>

        <section class="challenges-section">
            <h2>Challenges We Address</h2>
            <p>Planado PH operates as a non-governmental, non-profit initiative focused on addressing key reproductive health challenges in the Philippines, including:</p>
            <div class="challenges-list">
                <div class="challenge-item">
                    <h4>High Fertility Rates</h4>
                    <p>Providing tools and information to help families plan and space pregnancies appropriately.</p>
                </div>
                <div class="challenge-item">
                    <h4>Unmet Contraceptive Needs</h4>
                    <p>Educating about various family planning methods and their proper use.</p>
                </div>
                <div class="challenge-item">
                    <h4>Teenage Pregnancy</h4>
                    <p>Offering age-appropriate education and resources for young people.</p>
                </div>
                <div class="challenge-item">
                    <h4>Health Misinformation</h4>
                    <p>Combating myths and misconceptions with factual, science-based information.</p>
                </div>
                <div class="challenge-item">
                    <h4>Limited Access</h4>
                    <p>Bridging gaps in healthcare access through digital platforms and resources.</p>
                </div>
                <div class="challenge-item">
                    <h4>Cultural Barriers</h4>
                    <p>Addressing stigma and cultural barriers that prevent open discussion about reproductive health.</p>
                </div>
            </div>
        </section>

        <section class="action-section">
            <h2>Join Our Mission</h2>
            <p>Together, we can create a healthier, more informed Philippines. Start your journey toward better reproductive health today.</p>
            <a href="register.php" class="btn-white">Get Started</a>
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
        <li><a href="tools.php">Ovulation Tracker</a></li>
        <li><a href="reminder.php">Reminder</a></li>
        <li><a href="due-date-calculator.php">Due Date Calculator</a></li>
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


</body>
</html>