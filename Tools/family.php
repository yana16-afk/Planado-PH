<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Family Planning in the Philippines</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    .banner_family {
      border-radius: 20px;
      margin: 2rem auto;
      padding: 4rem;
      background-image: url('images/banner_contra.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      box-shadow: 0 4px 20px rgba(56, 14, 91, 0.09);
      width: 100%;
      max-width: 1400px;
    }

    .banner_family-content {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1400px;
      margin: 0 auto;
    }

    .banner_family-text {
      flex: 1;
      max-width: 600px;
    }

    .banner_family-text h1 {
      font-family: 'Fredoka', sans-serif;
      font-size: 3.5rem;
      color: #66173D;
      margin-bottom: 1rem;
      line-height: 1.2;
    }

    .banner_family-text p {
      font-size: 1.3rem;
      color: #B75196;
      margin-bottom: 2rem;
      line-height: 1.5;
    }

    .family-banner-image {
      width: 400px;
      height: 260px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .family-banner-image img {
      width: 80%;
      height: auto;
      object-fit: contain;
    }
    .family-info {
  padding: 2rem 4rem;
  max-width: 1400px;
  margin: 0 auto;
}

.family-info h2 {
  font-size: 2rem;
  color: #66173D;
  margin-bottom: 1.5rem;
}

.family-info p {
  font-size: 1.1rem;
  color: #333;
  line-height: 1.6;
  margin-bottom: 1rem;
}

.family-info ul {
  font-size: 1.1rem;
  color: #333;
  padding-left: 1.5rem;
  line-height: 1.6;
  list-style-type: disc;
}

.family-info ul li {
  margin-bottom: 0.5rem;
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
  grid-template-columns: repeat(3, 1fr); 
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
      <a href="login.php" class="sign-in-btn">Sign In</a>
    </nav>
  </header>

<section class="banner_family">
  <div class="banner_family-content">
    <div class="banner_family-text">
      <h1>Supporting Every Family’s Journey</h1>
      <p>Family planning empowers individuals and couples to determine the timing and spacing of their children. This section covers essential information on rights, services, and policies in the Philippines to promote reproductive health and well-being.</p>
    </div>
    <div class="family-banner-image">
      <img src="images/family-illustration.png" alt="Family Planning Banner">
    </div>
  </div>
</section>

<section class="family-info">
  <h2>Understanding Family Planning</h2>
  <p>
    Family planning refers to the practice of controlling the number and spacing of children through the use of contraceptive methods and the treatment of infertility. It is a key component of reproductive health and empowers individuals and couples to make informed decisions about their future.
  </p>
  <p>
    In the Philippines, Republic Act No. 10354, also known as the Responsible Parenthood and Reproductive Health Act of 2012, ensures access to reproductive health services, education, and family planning tools. It aims to promote the well-being of families, especially women and youth.
  </p>
  <ul>
    <li>Empowers couples to decide freely and responsibly the number and spacing of their children.</li>
    <li>Reduces maternal and infant mortality through planned pregnancies.</li>
    <li>Helps families achieve better economic and educational outcomes.</li>
    <li>Supports women’s rights and gender equality.</li>
  </ul>
  <p>
    Local health centers and barangay clinics often provide free or low-cost family planning services. It's important to seek advice from trusted health professionals for the method that best suits your needs.
  </p>
</section>

<section class="related-articles-section">
  <h2>📚 Family Planning Resources</h2>
  <div class="article-card-grid">
    <div class="article-card-v2">
      <img src="images/f1.png" alt="UNFPA">
      <h3>UNFPA Philippines | Family Planning</h3>
      <p>Overview of UNFPA’s programs and support for reproductive health in the Philippines.</p>
      <a href="https://philippines.unfpa.org/en/topics/family-planning" target="_blank">Read More</a>
    </div>
    <div class="article-card-v2">
      <img src="images/f2.png" alt="FP Handbook">
      <h3>Philippine Family Planning Handbook</h3>
      <p>Official guide covering contraceptive methods and RH services in the country.</p>
      <a href="https://www.deped.gov.ph/wp-content/uploads/Briefer_Comprehensive-Sexuality-Education-CSE_.pdf" target="_blank">Read More</a>
    </div>
    <div class="article-card-v2">
      <img src="images/f3.png" alt="Medical City">
      <h3>Importance of Family Planning</h3>
      <p>The Medical City highlights health benefits of informed reproductive choices.</p>
      <a href="https://www.themedicalcity.com/news/family-planning-basic-human-right" target="_blank">Read More</a>
    </div>
    <div class="article-card-v2">
      <img src="images/f4.png" alt="KFF">
      <h3>Family Planning Law for Universal Access</h3>
      <p>KFF reports on RA 10354 and its role in achieving reproductive health goals.</p>
      <a href="https://www.kff.org/news-summary/philippines-law-on-family-planning-will-help-country-achieve-universal-access-to-reproductive-health/" target="_blank">Read More</a>
    </div>
    <div class="article-card-v2">
      <img src="images/f5.png" alt="RA 10354">
      <h3>RA 10354: RH Law</h3>
      <p>Details on the Responsible Parenthood and Reproductive Health Act by PCW.</p>
      <a href="https://pcw.gov.ph/republic-act-10354/" target="_blank">Read More</a>
    </div>
    <div class="article-card-v2">
      <img src="images/f6.png" alt="TCI">
      <h3>Why is Family Planning Important?</h3>
      <p>The Challenge Initiative explains the value of family planning in urban settings.</p>
      <a href="https://tciurbanhealth.org/courses/what-is-family-planning/lessons/why-is-family-planning-important/" target="_blank">Read More</a>
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
