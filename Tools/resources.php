<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Planado PH - Resources & Articles</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Montserrat', sans-serif;
      margin: 0;
      background-color: #fff3f8;
      color: #333;
    }

    .header {
      background-color: #BA90C6;
      padding: 1rem 2rem;
      color: white;
      height: 60px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header h1 {
      font-size: 1.5rem;
      margin: 0;
    }

    .nav a {
      color: white;
      margin-left: 1rem;
      text-decoration: none;
      font-weight: 600;
    }

    .nav a:hover {
      text-decoration: underline;
    }

    .page-title {
      text-align: center;
      padding: 2rem 1rem 1rem;
      font-size: 2rem;
      color: #5e2a84;
    }

    .intro-text {
      text-align: center;
      max-width: 800px;
      margin: 0 auto 2rem;
      font-size: 1.1rem;
      color: #555;
    }

    .articles-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      padding: 2rem;
      max-width: 1200px;
      margin: 0 auto;
    }

    .article-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      overflow: hidden;
      transition: transform 0.2s;
    }

    .article-card:hover {
      transform: translateY(-5px);
    }

    .article-image img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .article-content {
      padding: 1rem;
    }

    .article-content h3 {
      margin: 0.5rem 0;
      color: #8E44AD;
    }

    .article-content p {
      font-size: 0.95rem;
      color: #444;
    }

    .read-more {
      display: inline-block;
      margin-top: 1rem;
      color: #BA90C6;
      font-weight: 600;
      text-decoration: none;
    }

    .read-more:hover {
      text-decoration: underline;
    }

    footer {
      background-color: #BA90C6;
      color: white;
      text-align: center;
      padding: 1.5rem;
      margin-top: 3rem;
    }

    .logo {
        display: flex;
        align-items: center;
        }

    .logo-icon {
        width: 200px;
        height: 60px;
        object-fit: contain;
        }
  </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="images/logo.png" class="logo-icon" alt="Planado PH Logo">
          </a>
        </div>
        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="tools.php">Tools</a>
            <a href="about.php">About</a>
        </nav>
    </header>
  <main>
    <h2 class="page-title">Educational Articles & Resources</h2>
    <p class="intro-text">
      Explore curated guides, tips, and health information designed to help you make informed decisions about contraception, pregnancy, and family planning. Updated for Filipino communities.
    </p>

    <div class="articles-container">
      <div class="article-card">
        <div class="article-image">
          <img src="images/Contraception.png" alt="Contraception Methods">
        </div>
        <div class="article-content">
          <h3>Contraception & Birth Control</h3>
          <p>Learn about the various contraceptive methods available, how they work, and which options might be best for you. This section aims to dispel myths and provide clear facts to help you take control of your reproductive health.</p>
          <a href="#" class="read-more">Read More</a>
        </div>
      </div>

      <div class="article-card">
        <div class="article-image">
          <img src="images/Pregnancy.png" alt="Pregnancy and Preconception">
        </div>
        <div class="article-content">
          <h3>Pregnancy & Preconception</h3>
          <p>Discover important steps to prepare your body and mind for a healthy pregnancy, including nutrition and medical care. Understand the early signs of pregnancy and what to expect during each trimester.</p>
          <a href="#" class="read-more">Read More</a>
        </div>
      </div>

      <div class="article-card">
        <div class="article-image">
          <img src="images/Family.png" alt="Family Planning & Reproductive Health">
        </div>
        <div class="article-content">
          <h3>Family Planning & Reproductive Health</h3>
          <p>Family planning empowers individuals and couples to decide freely and responsibly about having children. This section covers reproductive health basics, fertility awareness, and the benefits of planned parenthood.</p>
          <a href="#" class="read-more">Read More</a>
        </div>
      </div>

      <div class="article-card">
        <div class="article-image">
          <img src="images/Youth.png" alt="Youth Education">
        </div>
        <div class="article-content">
          <h3>Youth & Community Education</h3>
          <p>Providing age-appropriate, culturally sensitive education helps young people make safe and informed decisions about their sexual and reproductive health. This section also highlights community programs that support youth empowerment.</p>
          <a href="#" class="read-more">Read More</a>
        </div>
      </div>

      <div class="article-card">
        <div class="article-image">
          <img src="images/Legal.png" alt="Legal and Cultural Awareness">
        </div>
        <div class="article-content">
          <h3>Legal & Cultural Awareness</h3>
          <p>Understand the rights, laws, and cultural factors that influence access to reproductive health services in the Philippines. This section explains key legislation like the RH Law and addresses religious and societal perspectives on family planning.</p>
          <a href="#" class="read-more">Read More</a>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 Planado PH. Empowering your reproductive choices, every step of the way.</p>
  </footer>
</body>
</html>
