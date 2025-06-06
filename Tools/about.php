<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Planado PH</title>
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

        .nav a:hover, .nav a.active {
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

        /* Main Content - Full Width */
        .main-content {
            padding: 2rem 4rem;
            width: 100%;
        }

        .about-intro {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            padding: 4rem;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .about-intro::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(139, 74, 156, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(120deg); }
            66% { transform: translate(-20px, 20px) rotate(240deg); }
        }

        .about-intro-content {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
        }

        .about-intro-text {
            flex: 1;
            max-width: 600px;
        }

        .about-intro h1 {
            font-family: 'Fredoka', sans-serif;
            font-size: 3.5rem;
            color: #66173D;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .about-intro p {
            font-size: 1.3rem;
            color: #B75196;
            line-height: 1.6;
        }

        .about-intro-image {
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

        .mission-vision {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .mission-card, .vision-card {
            padding: 3rem;
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s;
        }

        .mission-card:hover, .vision-card:hover {
            transform: translateY(-5px);
        }

        .mission-card {
            background: linear-gradient(#BA90C6);
            color: #66173D;
        }

        .vision-card {
            background: linear-gradient(#66173D);
            color: #FDF4F5;
        }

        .mission-card h2, .vision-card h2 {
            font-family: 'Poppins';
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

        .mission-card p, .vision-card p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .challenges-section {
            background: rgba(139, 74, 156, 0.1);
            border-radius: 20px;
            padding: 4rem;
            margin-bottom: 3rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .challenges-section h2 {
            font-family: 'Fredoka', sans-serif;
            font-size: 2.5rem;
            color: #66173D;
            margin-bottom: 2rem;
            text-align: center;
        }

        .challenges-section p {
            font-size: 1.1rem;
            color: #66173D;
            line-height: 1.6;
            margin-bottom: 2rem;
            text-align: center;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .challenges-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .challenge-item {
            background: #FDF4F5;
            padding: 2rem;
            border-radius: 15px;
            border-left: 5px solid #66173D;
            transition: all 0.3s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .challenge-item:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(139, 74, 156, 0.1);
        }

        .challenge-item h4 {
            color: #66173D;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .action-section {
            background: linear-gradient(135deg, #66173D 0%, #B75196 100%);
            color: white;
            text-align: center;
            padding: 4rem;
            border-radius: 20px;
            margin-bottom: 3rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
        }

        .action-section h2 {
            font-family: 'Fredoka', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .action-section p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .btn-white {
            background: white;
            color: #66173D;
            padding: 1rem 2rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            font-size: 1.1rem;
        }

        .btn-white:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
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
            
            .about-intro {
                padding: 3rem;
            }
            
            .about-intro-content {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }
            
            .about-intro h1 {
                font-size: 3rem;
            }

            .about-intro-image {
                width: 300px;
                height: 250px;
                margin: 0 auto;
            }

            .woman-image {
                width: 280px;
                height: 220px;
                left: 10px;
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

            .about-intro {
                padding: 2rem;
            }

            .about-intro h1 {
                font-size: 2.5rem;
            }

            .mission-vision {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .mission-card, .vision-card {
                padding: 2rem;
            }

            .mission-card h2, .vision-card h2 {
                font-size: 2rem;
            }

            .challenges-list {
                grid-template-columns: 1fr;
            }

            .challenges-section, .action-section {
                padding: 2rem;
            }
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
            <a href="about.php" class="active">About</a>
            <a href="login.php" class="sign-in-btn">Sign In</a>
        </nav>
    </header>

    <main class="main-content">
        <section class="about-intro">
            <div class="about-intro-content">
                <div class="about-intro-text">
                    <h1>About Planado PH</h1>
                    <p>Planado PH is a digital platform dedicated to empowering Filipinos with accessible, accurate, and culturally sensitive information on family planning and reproductive health. We believe that everyone has the right to make informed decisions about their bodies and futures — and that starts with access to the right knowledge.</p>
                </div>
                <div class="about-intro-image">
                    <img src="images/woman-reading.png" 
                         alt="Woman" 
                         class="woman-image">
                    
                    <div class="animated-element">
                        <img src="images/animated.png"
                             alt="Animated Element" 
                             class="animated-image">
                    </div>
                </div>
            </div>
        </section>

        <section class="mission-vision">
            <div class="mission-card">
                <h2>Our Mission</h2>
                <p>To empower individuals and families in the Philippines by providing free, reliable, and culturally relevant reproductive health information and tools that support informed and responsible decision-making.</p>
            </div>
            <div class="vision-card">
                <h2>Our Vision</h2>
                <p>A future where every Filipino — regardless of age, gender, or socio-economic status — has the knowledge and resources to take control of their reproductive health, leading to healthier communities and more equitable opportunities.</p>
            </div>
        </section>

        <section class="challenges-section">
            <h2>Challenges We Address</h2>
            <p>Planado PH operates as a non-governmental, non-profit initiative focused on addressing key reproductive health challenges in the Philippines, including:</p>
            <div class="challenges-list">
                <div class="challenge-item">
                    <h4>High Fertility Rates</h4>
                    <p>Providing tools and information to help families plan and space pregnancies appropriately.</p>
                </div>
                <div class="challenge-item">
                    <h4>Unmet Contraceptive Needs</h4>
                    <p>Educating about various family planning methods and their proper use.</p>
                </div>
                <div class="challenge-item">
                    <h4>Teenage Pregnancy</h4>
                    <p>Offering age-appropriate education and resources for young people.</p>
                </div>
                <div class="challenge-item">
                    <h4>Health Misinformation</h4>
                    <p>Combating myths and misconceptions with factual, science-based information.</p>
                </div>
                <div class="challenge-item">
                    <h4>Limited Access</h4>
                    <p>Bridging gaps in healthcare access through digital platforms and resources.</p>
                </div>
                <div class="challenge-item">
                    <h4>Cultural Barriers</h4>
                    <p>Addressing stigma and cultural barriers that prevent open discussion about reproductive health.</p>
                </div>
            </div>
        </section>

        <section class="action-section">
            <h2>Join Our Mission</h2>
            <p>Together, we can create a healthier, more informed Philippines. Start your journey toward better reproductive health today.</p>
            <a href="register.php" class="btn-white">Get Started</a>
        </section>
    </main>
</body>
</html>