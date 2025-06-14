<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contraceptive Methods</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    .banner_contra {
      border-radius: 20px;
      margin: 2rem 4rem;
      padding: 4rem;
      background-image: url('images/banner_contra.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      box-shadow: 0 4px 20px rgba(56, 14, 91, 0.09);
    }

    .banner_contra-content {
      position: relative;
      z-index: 1;
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1400px;
      margin: 0 auto;
    }

    .banner_contra-text {
      flex: 1;
      max-width: 600px;
    }

    .banner_contra-text h1 {
      font-family: 'Fredoka', sans-serif;
      font-size: 3.5rem;
      color: #66173D;
      margin-bottom: 1rem;
      line-height: 1.2;
    }

    .banner_contra-text p {
      font-size: 1.3rem;
      color: #B75196;
      margin-bottom: 2rem;
      line-height: 1.5;
    }

    .contra-image {
      position: relative;
      width: 600px;
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .contra-image img {
      width: 80%;
      height: auto;
      object-fit: contain;
    }

    .contraceptive-cards {
      padding: 2rem 4rem;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 2rem;
      max-width: 1400px;
      margin: 0 auto;
    }

    .contraceptive-card {
      background:rgb(240, 229, 243);
      border-radius: 16px;
      padding: 2rem;
      text-align: center;
      box-shadow: 0 4px 20px rgba(56, 14, 91, 0.26);
      transition: transform 0.2s;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }

    .contraceptive-card:hover {
      transform: translateY(-5px);
    }

    .contraceptive-icon {
      width: 80px;
      height: 80px;
      object-fit: contain;
      margin: 0 auto 1rem;
      display: block;
    }

    .contraceptive-card h3 {
      margin-top: 1rem;
      font-size: 1.1rem;
      color: #66173D;
    }

    .hidden-desc {
      color: #4a2951;
      font-family: 'Fredoka', sans-serif;
      display: none;
      margin-top: 1rem;
    }
    .visible {
      display: block;
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
      <a href="contraceptives.php">Contraceptives</a>
      <a href="tools.php">Tools</a>
      <a href="resources.php">Resources</a>
      <a href="about.php">About</a>
      <a href="login.php" class="sign-in-btn">Sign In</a>
    </nav>
  </header>

  <section class="banner_contra">
    <div class="banner_contra-content">
      <div class="banner_contra-text">
        <h1>Contraceptive Methods</h1>
        <p>
          Discover a wide range of safe and effective birth control options to help you make informed decisions about your reproductive health. Whether you're exploring methods for the first time or considering a change, each method offers unique benefits depending on your lifestyle, health needs, and family planning goals. From hormonal options and barrier methods to permanent procedures and natural techniques, this guide is here to support your journey to confident, empowered choices.
        </p>
      </div>
      <div class="contra-image">
        <img src="images/contra.png" alt="Illustration">
      </div>
    </div>
  </section>

  <section class="contraceptive-cards">
    <div class="card-grid">
      <?php
        $methods = [
          ["Hormonal IUD", "A small, T-shaped device that releases hormones to prevent pregnancy for up to 5 years.", "images/hormonal-iud.png"],
          ["Non-Hormonal IUD", "A copper-based device that prevents pregnancy without hormones for up to 10 years.", "images/non-hormonal-iud.png"],
          ["Contraceptive Implant", "A small rod placed under the skin that releases hormones to prevent pregnancy for 3 years.", "images/implant.png"],
          ["Combined Oral Contraceptive Pill", "Taken daily, this pill contains estrogen and progestin to prevent ovulation.", "images/combined-pill.png"],
          ["Contraceptive Injections", "Hormone shots given every 3 months to prevent pregnancy.", "images/injection.png"],
          ["Contraceptive Patch", "A weekly skin patch that releases hormones to prevent ovulation.", "images/patch.png"],
          ["Birth Control Ring", "A monthly ring inserted in the vagina that releases pregnancy-preventing hormones.", "images/ring.png"],
          ["Emergency Contraceptive Pills", "Pills taken after unprotected sex to prevent pregnancy (morning-after pill).", "images/emergency-pill.png"],
          ["Condoms", "A barrier worn over the penis to prevent sperm from reaching the egg.", "images/condom.png"],
          ["Cervical Cap", "A small cap placed over the cervix to block sperm from entering the uterus.", "images/cervical-cap.png"],
          ["Diaphragm", "A flexible dome-shaped cup used with spermicide to prevent pregnancy.", "images/diaphragm.png"],
          ["Spermicide", "Chemicals that kill sperm, used alone or with barrier methods.", "images/spermicide.png"],
          ["Tubal Ligation", "A permanent female sterilization method that blocks the fallopian tubes.", "images/tubal-ligation.png"],
          ["Vasectomy", "A permanent male sterilization procedure that cuts or blocks the vas deferens.", "images/vasectomy.png"],
          ["Fertility Awareness Methods", "Tracking fertility signs to avoid or plan pregnancy.", "images/fertility-awareness.png"],
          ["Sexual Abstinence", "Refraining from sexual intercourse to avoid pregnancy.", "images/abstinence.png"]
        ];

        foreach ($methods as $method) {
          echo "
            <div class='contraceptive-card' onclick='toggleDescription(this)'>
              <img src='{$method[2]}' alt='{$method[0]}' class='contraceptive-icon'>
              <h3>{$method[0]}</h3>
              <p class='hidden-desc'>{$method[1]}</p>
            </div>
          ";
        }
      ?>
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

  <script>
    function toggleDescription(card) {
      const desc = card.querySelector('.hidden-desc');
      desc.classList.toggle('visible');
    }
  </script>

</body>
</html>
