<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Legal & Cultural Awareness</title>
  <link rel="stylesheet" href="style.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
  <style>
    .banner_legal {
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

    .banner_legal-text {
  flex: 1;
  max-width: 600px;
    }

    .banner_legal-text h1 {
  font-family: 'Fredoka', sans-serif;
  font-size: 3.5rem;
  color: #66173D;
  margin-bottom: 1rem;
  line-height: 1.2;
    }

    .banner_legal-text p {
  font-size: 1.3rem;
  color: #B75196;
  margin-bottom: 2rem;
  line-height: 1.5;
    }

    .legal-banner-image {
  width: 400px;
  height: 260px;
  display: flex;
  align-items: center;
  justify-content: center;
    }

    .legal-banner-image img {
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
      margin-top: 2rem;
      margin-bottom: 2rem;
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
      margin-bottom: 1.5 rem;
    }

    .article-card-v2 p {
      font-size: 0.95rem;
      color: #333;
      margin-bottom: 1.5 rem;
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

  <!-- Header -->
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

  <!-- Legal Awareness Banner -->
  <section class="banner_legal">
    <div class="banner_legal-text">
      <h1>Legal & Cultural Awareness</h1>
      <p>Understand the rights, laws, and cultural factors that influence access to reproductive health services in the
        Philippines. This section explains key legislation like the RH Law and addresses religious and societal
        perspectives on family planning.</p>
    </div>
    <div class="legal-banner-image">
      <img src="images/legalpicpink.png" alt="Legal Awareness Illustration">
    </div>
  </section>

  <!-- Article Cards -->
  <section class="articles-wrapper">
    <div class="article-card">
      <h3>The Responsible Parenthood and Reproductive Health Act</h3>
      <a href="https://pcw.gov.ph/republic-act-10354/" target="_blank">Read more</a>
    </div>
    <div class="article-card">
      <h3>Republic Act 10354 Official Publication</h3>
      <a href="https://www.officialgazette.gov.ph/2012/12/21/republic-act-no-10354/" target="_blank">Read more</a>
    </div>
    <div class="article-card">
      <h3>RA 10354 Implementing Rules & Regulations</h3>
      <a href="https://pcw.gov.ph/assets/files/2019/04/RA_10354_The-Responsible-Parenthood-and-Reproductive-Health-Act-of-2012_IRR.pdf"
        target="_blank">Read more</a>
    </div>
    <div class="article-card">
      <h3>RH Law in the Philippines</h3>
      <a href="https://www.asean-endocrinejournal.org/index.php/JAFES/article/view/48/471" target="_blank">Read more</a>
    </div>
    <div class="article-card">
      <h3>Republic Act 9710</h3>
      <a href="https://lawphil.net/statutes/repacts/ra2009/ra_9710_2009.html" target="_blank">Read more</a>
    </div>
    <div class="article-card">
      <h3>Republic Act 11210</h3>
      <a href="https://lawphil.net/statutes/repacts/ra2019/ra_11210_2019.html"
        target="_blank">Read more</a>
    </div>
  </section>

<section class="related-articles-section">
  <h2>Related Articles</h2>
  <div class="article-card-grid">
    <div class="article-card-v2">
      <img src="images/a.jpg" alt="Article Icon">
      <h3>Sex education: Protecting kids through information</h3>
      <a href="https://newsinfo.inquirer.net/2029272/sex-education-protecting-kids-through-information" target="_blank">Read More</a>
    </div>
    <div class="article-card-v2">
      <img src="images/b.webp" alt="Article Icon">
      <h3>Philippines: Sex ed bill targets rising teen pregnancies</h3>
      <a href="https://www.dw.com/en/philippines-sex-ed-bill-targets-rising-teen-pregnancies/a-71501177" target="_blank">Read More</a>
    </div>
    <div class="article-card-v2">
      <img src="images/d.png" alt="Article Icon">
      <h3>Gov’t to push for shorter working hours for moms</h3>
      <a href="https://newsinfo.inquirer.net/2058551/govt-to-push-for-shorter-working-hours-for-moms" target="_blank">Read More</a>
    </div>
  </div>
</section>


  <!-- Footer -->
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
