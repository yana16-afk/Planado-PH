<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planado PH</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #FDF4F5;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 4rem;
            background: #BA90C6;
            width: 100%;
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

        .nav {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .nav a {
            text-decoration: none;
            color: #66173D;
            font-size: 1.3rem;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav a:hover, .nav a.active  {
            color: #6B3A7C;
        }

        .sign-in-btn {
            background: white;
            color: #8B4A9C;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .sign-in-btn:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        .main-content {
            padding: 2rem 4rem;
            width: 100%;
        }

        .banner {
            background-image: url('images/banner.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 20px;
            padding: 4rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .banner-content {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .banner-text {
            flex: 1;
            max-width: 600px;
        }

        .banner h1 {
            font-family: 'Fredoka', sans-serif;
            font-size: 3.5rem;
            color: #66173D;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .banner p {
            font-size: 1.3rem;
            color: #B75196;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .banner-buttons {
            display: flex;
            gap: 1rem;
        }

        .btn-primary {
            background: #66173D;
            color: #FDF4F5;
            padding: 1rem 2rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background: #aa185f;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #BA90C6;
            color: #FDF4F5;
            padding: 1rem 2rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-secondary:hover {
            background: #BA90C6;
            transform: translateY(-2px);
        }

        .banner-image {
            position: relative;
            width: 500px;
            height: 350px;
        }

        .woman-image {
            width: 400px;
            height: 320px;
            object-fit: contain;
            position: absolute;
            bottom: 0;
            left: 50px;
        }

        .animated-element {
            width: 150px;
            height: 150px;
            position: absolute;
            top: 10px;
            right: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .animated-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            animation: elementFloat 4s ease-in-out infinite;
            filter: drop-shadow(0 5px 15px rgba(255, 105, 180, 0.3));
        }

        @keyframes elementFloat {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            25% {
                transform: translateY(-10px) rotate(2deg);
            }
            50% {
                transform: translateY(-5px) rotate(0deg);
            }
            75% {
                transform: translateY(-15px) rotate(-2deg);
            }
        }

        .featured-section {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 2.5rem;
            color: #66173D;

            margin-bottom: 2rem;
            font-weight: bold;
        }

        .featured-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .featured-card {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s, outline-color 0.3s;
            outline: 2px solid #D1D5DB;
            outline-offset: 2px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .featured-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(139, 74, 156, 0.2);
            outline-color: #9CA3AF;
        }

        .featured-card:nth-child(1) {
            background: #FDF6F4;
            outline: 1px solid #D1D5DB;
        }

        .featured-card:nth-child(2) {
            background: #FDF6F4;
            outline: 1px solid #D1D5DB;
        }

        .featured-card:nth-child(3) {
            background: #FDF6F4;
            outline: 1px solid #D1D5DB;
        }

        .card-image {
            width: 100%;
            height: 220px;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content {
            padding: 2rem;
        }

        .card-content p {
            color: #374151;
            margin-bottom: 1rem;
            line-height: 1.4;
            font-size: 1rem;
        }

        .read-more {
            color: #8B4A9C;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .read-more:hover {
            color: #6B3A7C;
        }

        .tools-section {
            margin-bottom: 4rem;
        }

        .tools-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .tool-card {
            background: #BA90C6;
            border-radius: 15px;
            padding: 3rem;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            overflow: hidden;
        }

        .tool-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(139, 74, 156, 0.3);
        }

        .tool-icon {
            width: 120px;
            height: 100px;
            border-radius: 10px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .tool-icon img {
            width: 400px;
            height: 100px;
            object-fit: contain;
        }

        .tool-button {
            background: #66173D;
            color: white;
            padding: 1rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            display: inline-block;
            margin-top: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1.1rem;
        }

        .tool-button:hover {
            background: #aa185f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 23, 61, 0.3);
            color: white;
        }

        .tool-button:active {
            transform: translateY(0);
            box-shadow: 0 2px 6px rgba(102, 23, 61, 0.3);
        }

        .tool-name {
            background: #66173D;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            display: inline-block;
            margin-top: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .tool-name:hover {
            background: #aa185f;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 23, 61, 0.3);
            color: white;
        }

        @media (max-width: 1200px) {
            .main-content {
                padding: 2rem 3rem;
            }
            
            .header {
                padding: 1rem 3rem;
            }
        }

        @media (max-width: 968px) {
            .main-content {
                padding: 2rem;
            }
            
            .header {
                padding: 1rem 2rem;
            }
            
            .banner {
                padding: 3rem;
            }
            
            .banner h1 {
                font-size: 3rem;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .nav {
                gap: 1rem;
            }

            .main-content {
                padding: 1rem;
            }

            .banner {
                padding: 2rem;
            }

            .banner-content {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }

            .banner h1 {
                font-size: 2rem;
            }

            .banner-buttons {
                flex-direction: column;
                align-items: center;
            }

            .banner-image {
                width: 300px;
                height: 250px;
                margin: 0 auto;
            }

            .woman-image {
                width: 280px;
                height: 220px;
                left: 10px;
            }

            .featured-grid,
            .tools-grid {
                grid-template-columns: 1fr;
            }
            
            .section-title {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
          <a href="index.php"></a>
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

    <main class="main-content">
        <section class="banner">
            <div class="banner-content">
                <div class="banner-text">
                    <h1>Take control of your reproductive health</h1>
                    <p>Access reliable information and tools for planning and reproductive health</p>
                    <div class="banner-buttons">
                        <a href="register.php" class="btn-primary">Start Tracking</a>
                        <a href="resources.php" class="btn-secondary">Explore Resources</a>
                    </div>
                </div>
                <div class="banner-image">
                    <img src="images/woman-reading.png" alt="Woman" class="woman-image">
                    <div class="animated-element">
                        <img src="images/animated.png" alt="Animated Element" class="animated-image">
                    </div>
                </div>
            </div>
        </section>

        <section class="featured-section">
            <h2 class="section-title">Featured Content</h2>
            <div class="featured-grid">
                <div class="featured-card">
                    <div class="card-image">
                        <img src="images/syringe.png" alt="Syringe and Vial">
                    </div>
                    <div class="card-content">
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus.</p>
                        <a href="article1.php" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="featured-card">
                    <div class="card-image">
                        <img src="images/pregnancytest.png" alt="Pregnancy Test">
                    </div>
                    <div class="card-content">
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus.</p>
                        <a href="article2.php" class="read-more">Read More</a>
                    </div>
                </div>
                <div class="featured-card">
                    <div class="card-image">
                        <img src="images/reproductive.png" alt="Reproductive System">
                    </div>
                    <div class="card-content">
                        <p>Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus.</p>
                        <a href="article3.php" class="read-more">Read More</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="tools-section">
            <h2 class="section-title">Quick Tools</h2>
            <div class="tools-grid">
                <div class="tool-card">
                    <div class="tool-icon">
                        <img src="images/calendar.png" alt="Calendar Icon">
                    </div>
                    <a href="ovulation-tracker.php" class="tool-button">
                        Ovulation Tracker
                    </a>
                </div>
                <div class="tool-card">
                    <div class="tool-icon">
                        <img src="images/pills.png" alt="Pills Icon">
                    </div>
                    <a href="reminder.php" class="tool-button">
                        Reminder
                    </a>
                </div>
                <div class="tool-card">
                    <div class="tool-icon">
                        <img src="images/baby.png" alt="Baby Icon">
                    </div>
                    <a href="due-date-calculator.php" class="tool-button">
                        Due Date Calculator
                    </a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>