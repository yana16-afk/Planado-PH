<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Youth & Community Education</title>
  <link rel="stylesheet" href="style.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
  <style>
.banner_youth {
  border-radius: 20px;
      margin: 2rem 4rem;
      padding: 4rem;
      background-image: url('images/banner_contra.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      box-shadow: 0 4px 20px rgba(56, 14, 91, 0.09);
}

.banner_youth-content {
  position: relative;
      z-index: 1;
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1400px;
      margin: 0 auto;
}

.banner_youth-text {
  flex: 1;
  max-width: 600px;
}

.banner_youth-text h1 {
  font-family: 'Fredoka', sans-serif;
  font-size: 3.5rem;
  color: #66173D;
  margin-bottom: 1rem;
  line-height: 1.2;
}

.banner_youth-text p {
  font-size: 1.3rem;
  color: #B75196;
  margin-bottom: 2rem;
  line-height: 1.5;
}

    .youth-banner-image {
      width: 400px;
      height: 260px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .youth-banner-image img {
      width: 80%;
      height: auto;
      object-fit: contain;
    }

    .youth-programs {
      padding: 2rem;
      max-width: 1400px;
      margin: 0 auto;
    }

    .youth-programs h2 {
      font-size: 2rem;
      margin-bottom: 2rem;
      color: #66173D;
    }

    .program-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
    }

    .program-card {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(56, 14, 91, 0.1);
      padding: 2rem;
      text-align: center;
    }

    .program-card h3 {
      color: #B75196;
      margin-bottom: 0.5rem;
    }

    .program-card p {
      font-size: 1rem;
      color: #555;
      margin-bottom: 1rem;
    }

    .program-card a {
      color: #66173D;
      text-decoration: none;
      font-weight: 500;
    }

    .program-card a:hover {
      text-decoration: underline;
    }

    .related-articles-section {
      padding: 2rem;
      max-width: 1400px;
      margin: 0 auto;
    }

    .related-articles-section h2 {
      font-size: 2rem;
      margin-bottom: 2rem;
      color: #66173D;
    }

    .article-card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      margin-top: 2rem;
    }

    .article-card-v2 {
      background-color: #fff;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(56, 14, 91, 0.1);
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .article-card-v2 img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-top-left-radius: 16px;
      border-top-right-radius: 16px;
    }


    .article-card-v2 h3 {
      font-size: 1.1rem;
      color: #A8437B;
      margin-bottom: 0.8rem;
    }

    .article-card-v2 p {
      font-size: 0.95rem;
      color: #333;
      margin-bottom: 1rem;
    }

    .article-card-v2 a {
      font-weight: 600;
      color: #B75196;
      text-decoration: none;
    }

    .article-card-v2 a:hover {
      color: #66173D;
      text-decoration: underline;
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

  <section class="banner_youth">
    <div class="banner_youth-content">
      <div class="banner_youth-text">
        <h1>Empowering the Next Generation</h1>
        <p>Providing age-appropriate, culturally sensitive education helps young people make safe and informed decisions
          about their sexual and reproductive health. This section also highlights community programs that support youth
          empowerment.</p>
      </div>
      <div class="youth-banner-image">
        <img src="images/youth-illustration.png" alt="Youth Education Banner">
      </div>
    </div>
  </section>

  <section class="youth-programs">
    <h2>Featured Youth Programs</h2>
    <div class="program-grid">
      <div class="program-card">
        <h3>DOH Adolescent Health Program</h3>
        <p>Comprehensive services and guidance for adolescents by the Department of Health.</p>
        <a href="https://caro.doh.gov.ph/adolescent-health-program/" target="_blank">Learn More</a>
      </div>
      <div class="program-card">
        <h3>Y-PEER Philippines</h3>
        <p>Peer-led education network empowering young people through sexual health awareness.</p>
        <a href="https://www.facebook.com/ypeerpilipinas/" target="_blank">Learn More</a>
      </div>
      <div class="program-card">
        <h3>FPOP Youth Arm</h3>
        <p>Youth-led advocacy arm of the Family Planning Organization of the Philippines.</p>
        <a href="https://fpop1969.org/about-fpop/our-work/" target="_blank">Learn More</a>
      </div>
    </div>
  </section>
  <section class="related-articles-section">
    <h2>Related Articles</h2>
    <div class="article-card-grid">
      <div class="article-card-v2">
        <img src="images/y1.png" alt="Article Icon">
        <h3>Comprehensive Sexuality Education (CSE)</h3>
        <p>Briefer from DepEd detailing CSE integration into the curriculum for youth development.</p>
        <a href="https://www.deped.gov.ph/wp-content/uploads/Briefer_Comprehensive-Sexuality-Education-CSE_.pdf"
          target="_blank">Read More</a>
      </div>
      <div class="article-card-v2">
        <img src="images/y2.png" alt="Article Icon">
        <h3>RH Education in a Filipino City</h3>
        <p>A case study from ScienceDirect on implementing reproductive health education locally.</p>
        <a href="https://www.sciencedirect.com/science/article/pii/S0738059323000548" target="_blank">Read More</a>
      </div>
      <div class="article-card-v2">
        <img src="images/y3.png" alt="Article Icon">
        <h3>DOH Adolescent Health Program</h3>
        <p>Services and programs from the Department of Health promoting youth wellness.</p>
        <a href="https://caro.doh.gov.ph/adolescent-health-program/" target="_blank">Read More</a>
      </div>
      <div class="article-card-v2">
        <img src="images/y4.png" alt="Article Icon">
        <h3>Improving Sexual Health Education</h3>
        <p>Trust.ph initiative promoting safe practices and information in schools and communities.</p>
        <a href="https://trust.ph/improving-sexual-health-education-efforts-to-spread-accurate-information-and-promote-safe-practices-in-schools-and-communities/"
          target="_blank">Read More</a>
      </div>
    </div>
  </section>

  <footer class="modern-footer">
    <div class="footer-main">
      <div class="footer-column footer-logo-column">
        <img src="images/whitelogo.png" alt="Planado PH Logo" class="footer-logo">
        <p class="footer-tagline">Kapag sigurado, Gawing PLANADO!</p>
      </div>
      <div class="footer-column">
        <h4>Tools</h4>
        <ul>
          <li><a href="tools.php">Ovulation Tracker</a></li>
          <li><a href="reminder.php">Reminder</a></li>
          <li><a href="due-date-calculator.php">Due Date Calculator</a></li>
        </ul>
      </div>
      <div class="footer-column">
        <h4>About</h4>
        <ul>
          <li><a href="about.php">Our Mission</a></li>
          <li><a href="resources.php">Resources</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 Planado PH. All rights reserved.</p>
    </div>
  </footer>
</body>

</html>