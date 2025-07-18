<?php
session_start();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
$initials = $user_name ? strtoupper(substr($user_name, 0, 2)) : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Resources & Articles</title>
  <link rel="stylesheet" href="style.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
</head>

<body>

<header class="header">
  <div class="logo">
    <a href="index.php">
      <img src="images/logo.png" class="logo-icon" alt="Planado PH Logo">
    </a>
  </div>

  <nav class="nav">
    <a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Home</a>
    <a href="tools.php" class="<?= basename($_SERVER['PHP_SELF']) == 'tools.php' ? 'active' : '' ?>">Tools</a>
    <a href="resources.php" class="<?= basename($_SERVER['PHP_SELF']) == 'resources.php' ? 'active' : '' ?>">Resources</a>
    <a href="about.php" class="<?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>">About</a>

    <?php if (isset($_SESSION['user_id'])): ?>
      <?php
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


  <main>
    <h2 class="page-title">Educational Articles & Resources</h2>
    <p class="intro-text">
      Explore curated guides, tips, and health information designed to help you make informed decisions about
      contraception, pregnancy, and family planning. Updated for Filipino communities.
    </p>

    <div class="articles-container">
      <div class="article-card">
        <div class="article-image">
          <img src="images/Contraception.png" alt="Contraception Methods">
        </div>
        <div class="article-content">
          <h3>Contraception & Birth Control</h3>
          <p>Learn about the various contraceptive methods available, how they work, and which options might be best for
            you. This section aims to dispel myths and provide clear facts to help you take control of your reproductive
            health.</p>
          <a href="contraceptives.php" class="read-more">Read More</a>
        </div>
      </div>

      <div class="article-card">
        <div class="article-image">
          <img src="images/Pregnancy.png" alt="Pregnancy and Preconception">
        </div>
        <div class="article-content">
          <h3>Pregnancy & Preconception</h3>
          <p>Discover important steps to prepare your body and mind for a healthy pregnancy, including nutrition and
            medical care. Understand the early signs of pregnancy and what to expect during each trimester.</p>
          <a href="Preg_article.php" class="read-more">Read More</a>
        </div>
      </div>

      <div class="article-card">
        <div class="article-image">
          <img src="images/Family.png" alt="Family Planning">
        </div>
        <div class="article-content">
          <h3>Family Planning</h3>
          <p>Family planning empowers individuals and couples to decide freely and responsibly about having children. This section covers fertility awareness and benefits of planned parenthood.</p>
          <a href="family.php" class="read-more">Read More</a>
        </div>
      </div>

      <div class="article-card">
        <div class="article-image">
          <img src="images/Youth.png" alt="Youth Education">
        </div>
        <div class="article-content">
          <h3>Youth & Community Education</h3>
          <p>Providing age-appropriate, culturally sensitive education helps young people make safe and informed
            decisions about their sexual and reproductive health. This section also highlights community programs that
            support youth empowerment.</p>
          <a href="youth.php" class="read-more">Read More</a>
        </div>
      </div>

      <div class="article-card">
        <div class="article-image">
          <img src="images/reproductivehealth.png" alt="Reproductive Health">
        </div>
        <div class="article-content">
          <h3>Reproductive Health</h3>
          <p>Explore the essentials of reproductive health, including how your body works, fertility tracking, and the
            importance of informed and intentional parenthood choices for a healthier future.</p>
          <a href="#" class="read-more">Read More</a>
        </div>
      </div>

      <div class="article-card">
        <div class="article-image">
          <img src="images/Legal.png" alt="Legal and Cultural Awareness">
        </div>
        <div class="article-content">
          <h3>Legal & Cultural Awareness</h3>
          <p>Understand the rights, laws, and cultural factors that influence access to reproductive health services in
            the Philippines. This section explains key legislation like the RH Law and addresses religious and societal
            perspectives on family planning.</p>
          <a href="Legal.php" class="read-more">Read More</a>
        </div>
      </div>
    </div>
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