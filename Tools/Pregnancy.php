<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pregnancy & Preconception</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    .banner_pregnancy {
      border-radius: 20px;
      margin: 2rem auto;
      padding: 2rem;
      background-image: url('images/banner_contra.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      box-shadow: 0 4px 20px rgba(56, 14, 91, 0.09);
      width: 100%;
      max-width: 1400px;
      display: flex;
      justify-content: space-between;
      gap: 2rem;
    }

    .banner_preg-text {
      flex: 1;
      max-width: 600px;
    }

    .banner_preg-text h1 {
      font-family: 'Fredoka', sans-serif;
      font-size: 3.5rem;
      color: #66173D;
      margin-bottom: 1rem;
      line-height: 1.2;
    }

    .banner_preg-text p {
      font-size: 1.3rem;
      color: #B75196;
      margin-bottom: 2rem;
      line-height: 1.5;
    }

    .preg-banner-image {
      width: 400px;
      height: 260px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .preg-banner-image img {
      width: 100%;
      height: auto;
      object-fit: contain;
    }

    .articles-wrapper {
      max-width: 1200px;
      margin: 60px auto;
      padding: 0 20px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
    }

    .article-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
      padding: 20px;
      transition: transform 0.2s ease;
    }

    .article-card:hover {
      transform: translateY(-5px);
    }

    .article-card h3 {
      font-size: 1.2rem;
      color: #66173D;
      margin-bottom: 10px;
      font-weight: 600;
    }

    .article-card a {
      text-decoration: none;
      color: #333;
      font-size: 0.95rem;
      display: inline-block;
      margin-top: 5px;
      transition: color 0.3s;
    }

    .article-card a:hover {
      color: #B75196;
    }

    .related-articles-section {
      padding: 1rem 10px;
      max-width: 1200px;
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
      margin: 2rem 0;
      padding: 0 80px;
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
      margin-bottom: 1.5rem;
    }

    .article-card-v2 p {
      font-size: 0.95rem;
      color: #333;
      margin-bottom: 1.5rem;
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
      <a href="login.php" class="sign-in-btn">Sign In</a>
    </nav>
  </header>

  <main class="content-page">
    <section class="banner_pregnancy">
      <div class="banner_preg-text">
        <h1>Pregnancy & Preconception</h1>
        <p>Discover important steps to prepare your body and mind for a healthy pregnancy, including nutrition and medical care. Understand the early signs of pregnancy and what to expect during each trimester.</p>
      </div>
      <div class="preg-banner-image">
        <img src="images/preg.png" alt="Pregnancy Banner">
      </div>
    </section>

    <section class="related-articles-section">
      <h2>Related Articles</h2>
      <div class="article-card-grid">
        <div class="article-card-v2">
          <img src="images/15.png" alt="Checklist Icon">
          <h3>Pregnancy Preparation Checklist</h3>
          <p><a href="https://hellodoctor.com.ph/pregnancy/getting-pregnant/pregnancy-preparation-checklist/" target="_blank">Read more</a></p>
        </div>
        <div class="article-card-v2">
          <img src="images/16.png" alt="Pregnancy Icon">
          <h3>About Pregnancy</h3>
          <p><a href="https://www.nichd.nih.gov/health/topics/pregnancy/conditioninfo/" target="_blank">Read more</a></p>
        </div>
        <div class="article-card-v2">
          <img src="images/17.png" alt="RiteMed Icon">
          <h3>Mga Signs ng Pagbubuntis</h3>
          <p><a href="https://ritemed.com.ph/pregnancy/mga-signs-ng-pagbubuntis/" target="_blank">Read more</a></p>
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
