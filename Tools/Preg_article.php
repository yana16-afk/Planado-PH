<?php
session_start();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
$initials = $user_name ? strtoupper(substr($user_name, 0, 2)) : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pregnancy & Preconception</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #fefefe;
      color: #333;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 15px 40px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .logo img {
      height: 50px;
    }

    .nav a {
      margin: 0 15px;
      text-decoration: none;
      color: #555;
      font-weight: 500;
      transition: color 0.3s;
    }

    .nav a:hover,
    .nav .active {
      color: #0077b6;
    }

    .content-page {
      max-width: 900px;
      margin: 60px auto;
      padding: 0 25px;
    }

    .page-title {
      font-size: 2.2rem;
      color: #0a3d62;
      margin-bottom: 10px;
    }

    .intro-text {
      font-size: 1.1rem;
      color: #444;
      line-height: 1.7;
      margin-bottom: 30px;
    }

    .article-section h3 {
      font-size: 1.5rem;
      margin-top: 40px;
      color: #222;
    }

    .article-section h4 {
      font-size: 1.2rem;
      margin-top: 20px;
      color: #555;
    }

    .article-section p,
    .article-section ul {
      line-height: 1.7;
      color: #444;
    }

    .article-section ul {
      padding-left: 25px;
      margin: 10px 0 20px;
    }

    .article-section ul li {
      margin-bottom: 8px;
    }

    .article-section a {
      color: #0077b6;
      text-decoration: none;
    }

    .article-section a:hover {
      text-decoration: underline;
    }

    .related-articles-section {
      padding: 4rem 2rem;
    }

    .related-articles-section h2 {
      font-family: 'Fredoka', sans-serif;
      font-size: 2.5rem;
      color: #66173D;
      margin-bottom: 1rem;
    }

    .article-scroll-container {
      display: flex;
      overflow-x: auto;
      gap: 1.5rem;
      padding: 2rem 0;
      scrollbar-width: thin;
      scrollbar-color: rgba(162, 113, 177, 0.34) transparent;
    }

    .article-scroll-container::-webkit-scrollbar {
      height: 8px;
    }

    .article-scroll-container::-webkit-scrollbar-thumb {
      background-color: rgba(162, 113, 177, 0.34);
      border-radius: 4px;
    }

    .article-card {
      flex: 0 0 280px;
      background-color: #fff;
      border-radius: 14px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      padding: 1.5rem;
      text-align: center;
      transition: transform 0.2s;
    }

    .article-card:hover {
      transform: translateY(-5px);
    }

    .article-card img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 10px;
      margin-bottom: 1rem;
    }

    .article-card a {
      font-family: 'Poppins', sans-serif;
      font-size: 0.95rem;
      color: #0077b6;
      text-decoration: none;
      line-height: 1.4;
      transition: color 0.3s;
    }

    .article-card a:hover {
      color: #023e8a;
    }

    .modern-footer {
      background-color: #0a3d62;
      color: #fff;
      padding: 40px 20px 20px;
    }

    .footer-main {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      max-width: 1100px;
      margin: auto;
    }

    .footer-column {
      flex: 1 1 200px;
      margin: 15px;
    }

    .footer-logo {
      height: 60px;
      margin-bottom: 10px;
    }

    .footer-tagline {
      font-size: 0.95rem;
      font-weight: 300;
    }

    .footer-column h4 {
      margin-bottom: 10px;
      font-size: 1.1rem;
    }

    .footer-column ul {
      list-style: none;
      padding: 0;
    }

    .footer-column ul li {
      margin: 8px 0;
    }

    .footer-column ul li a {
      color: #cce7ff;
      text-decoration: none;
      transition: color 0.3s;
    }

    .footer-column ul li a:hover {
      color: #fff;
    }

    .footer-bottom {
      text-align: center;
      margin-top: 30px;
      font-size: 0.85rem;
    }

    @media (max-width: 768px) {
      .header, .nav {
        flex-direction: column;
        align-items: center;
      }

      .nav a {
        margin: 5px 10px;
      }

      .footer-main {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .footer-column {
        margin: 20px 0;
      }

      .nav .sign-in-btn {
        background-color: #8B4A9C;
        color: white; 
        border-radius: 8px;
        text-decoration: none;
      }
      .nav .sign-in-btn:hover {
        background-color: #66173D;
      }
    }
  </style>
</head>
<body>

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

    <?php if ($user_name): ?>
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




      <main class="content-page">
    <img src="images/14.png" alt="Contraceptive Banner" style="width: 100%; max-height: 300px; object-fit: cover; border-radius: 12px; margin-bottom: 25px;">

    <h2 class="page-title">Pregnancy & Preconception</h2>
    <p class="intro-text">
      Discover important steps to prepare your body and mind for a healthy pregnancy, including nutrition and medical care. Understand the early signs of pregnancy and what to expect during each trimester.
    </p>

    <section class="article-section">
      <h3>Preparing for Pregnancy</h3>
      <ul>
        <li>Start taking folic acid at least 1 month before conception</li>
        <li>Visit your healthcare provider for a pre-pregnancy check-up</li>
        <li>Adopt a balanced diet rich in nutrients</li>
        <li>Limit alcohol, caffeine, and avoid tobacco use</li>
        <li>Manage stress and get regular exercise</li>
      </ul>

      <h3>Nutrition Tips</h3>
      <p>
        Eat a variety of healthy foods including fruits, vegetables, lean proteins, and whole grains. Iron, calcium, and folic acid are especially important during pregnancy.
      </p>

      <h3>Signs of Pregnancy</h3>
      <ul>
        <li>Missed period</li>
        <li>Nausea or vomiting (morning sickness)</li>
        <li>Fatigue</li>
        <li>Breast tenderness</li>
        <li>Frequent urination</li>
      </ul>

      <h3>What to Expect by Trimester</h3>
      <h4>First Trimester (Weeks 1–12)</h4>
      <p>Key developments: heartbeat begins, major organs form. Common symptoms: morning sickness, fatigue.</p>

      <h4>Second Trimester (Weeks 13–26)</h4>
      <p>Symptoms ease, baby’s movements become noticeable, body changes more visibly.</p>

      <h4>Third Trimester (Weeks 27–40)</h4>
      <p>Baby gains weight, final growth. Important to prepare for labor and delivery.</p>

      <h3>Prenatal Care Checklist</h3>
      <ul>
        <li>Attend all prenatal visits</li>
        <li>Get recommended screenings and ultrasounds</li>
        <li>Ask questions and learn about birth plans</li>
      </ul>
    </section>

    <section class="related-articles-section">
      <h2>Related Articles</h2>
      <div class="article-scroll-container">
        <div class="article-card">
          <img src="images/15.png" alt="Article Icon">
          <a href="https://hellodoctor.com.ph/pregnancy/getting-pregnant/pregnancy-preparation-checklist/" target="_blank">
            Pregnancy Preparation Checklist | HelloDoctor PH
          </a>
        </div>
        <div class="article-card">
          <img src="images/16.png" alt="Article Icon">
          <a href="https://www.nichd.nih.gov/health/topics/pregnancy/conditioninfo/" target="_blank">
            About Pregnancy
          </a>
        </div>
        <div class="article-card">
          <img src="images/17.png" alt="Article Icon">
          <a href="https://ritemed.com.ph/pregnancy/mga-signs-ng-pagbubuntis/" target="_blank">
            Mga Signs ng Pagbubuntis | RiteMed
          </a>
        </div>
        <div class="article-card">
          <img src="images/18.png" alt="Article Icon">
          <a href="https://www.ritemed.com.ph/articles/articles/mga-karaniwang-pregnancy-complications/" target="_blank">
            Karaniwang Pregnancy Complications | RiteMed
          </a>
        </div>
      </div>
    </section>
  </main>

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

  