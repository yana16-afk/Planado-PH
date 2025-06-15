<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reproductive Health</title>
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
        <h1>Reproductive Health</h1>
        <p>Explore the essentials of reproductive health, including how your body works, fertility tracking, and the importance of informed and intentional parenthood choices for a healthier future.</p>
      </div>
      <div class="preg-banner-image">
        <img src="images/rep.png" alt="Reproductive Health Banner">
      </div>
    </section>

    <section class="related-articles-section">
      <h2>Related Articles</h2>
      <div class="article-card-grid">
        <div class="article-card-v2">
          <img src="images/who.webp" alt="Repro Basics Icon">
          <h3>Reproductive Health: What It Means & Why It Matters</h3>
          <p><a href="https://www.who.int/westernpacific/health-topics/reproductive-health" target="_blank">Read more</a></p>
        </div>
        <div class="article-card-v2">
          <img src="images/fmed.png" alt="Fertility Tracking Icon">
          <h3>Fertility Awareness‑Based Methods of Family Planning</h3>
          <p><a href="https://www.acog.org/womens-health/faqs/fertility-awareness-based-methods-of-family-planning" target="_blank">Read more</a></p>
        </div>
        <div class="article-card-v2">
          <img src="images\ryhtm.jpg" alt="Healthy Choices Icon">
          <h3>Fertility Awareness</h3>
          <p><a href="https://my.clevelandclinic.org/health/articles/17900-rhythm-method" target="_blank">Read more</a></p>
        </div>
        <div class="article-card-v2">
          <img src="images\ftrack.jpg" alt="Body Education Icon">
          <h3>Can You Really Trust Your Fertility Tracker?</h3>
          <p><a href="https://www.dailytelegraph.com.au/lifestyle/can-you-really-trust-that-fertility-tracker-on-your-device/news-story/c4395cd9902a1dd72a7ed33fe9be23e1?utm_source=chatgpt.com" target="_blank">Read more</a></p>
        </div>
         <div class="article-card-v2">
          <img src="images/cal.webp" alt="Body Education Icon">
          <h3>What's the calendar method of FAMs?</h3>
          <p><a href="https://www.plannedparenthood.org/learn/birth-control/fertility-awareness/whats-calendar-method-fams" target="_blank">Read more</a></p>
        </div> 
        <div class="article-card-v2">
          <img src="images/rhealth.jpg" alt="Body Education Icon">
          <h3>About Reproductive Health</h3>
          <p><a href="https://www.cdc.gov/reproductive-health/about/index.html" target="_blank">Read more</a></p>
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
