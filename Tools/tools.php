<?php
session_start();
require_once 'planado_db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit();
}

// Get user information from session
$user_name = $_SESSION['user_name'];
$user_initials = $_SESSION['user_initials'] ?? strtoupper(substr($user_name, 0, 2));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tools - Planado PH</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
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
            color: #ffffff;
            font-size: 1.3rem;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav a:hover,
        .nav a.active {
            color: #6B3A7C;
        }

        /* User Profile Dropdown */
        .user-profile {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s;
        }

        .user-profile:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #66173D;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-info {
            color: white;
            font-size: 0.9rem;
        }

        .user-name {
            font-weight: 600;
        }

        .dropdown-arrow {
            color: white;
            font-size: 0.8rem;
            transition: transform 0.3s;
        }

        .user-profile:hover .dropdown-arrow {
            transform: rotate(180deg);
        }

        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            min-width: 150px;
            margin-top: 0.5rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s;
            z-index: 1000;
        }

        .user-profile:hover .user-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .user-dropdown a {
            display: block;
            padding: 0.75rem 1rem;
            color: #333;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background 0.3s;
        }

        .user-dropdown a:hover {
            background: #f5f5f5;
        }

        .user-dropdown a:first-child {
            border-radius: 10px 10px 0 0;
        }

        .user-dropdown a:last-child {
            border-radius: 0 0 10px 10px;
            color: #e74c3c;
        }

        /* Main Content */
        .main-content {
            padding: 2rem 4rem;
            width: 100%;
        }

        .tools-page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .tools-page-header h1 {
            font-family: 'Fredoka', sans-serif;
            font-size: 3.5rem;
            color: #66173D;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .tools-page-header p {
            font-size: 1.3rem;
            color: #B75196;
            margin-bottom: 2rem;
            line-height: 1.5;
            max-width: 800px;
            margin: 0 auto;
        }

        .tools-landing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .landing-tool-card {
            background: rgba(186, 144, 198, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .landing-tool-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .landing-tool-card:hover::before {
            left: 100%;
        }

        .landing-tool-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(139, 74, 156, 0.3);
        }

        .landing-tool-icon {
            width: 120px;
            height: 100px;
            border-radius: 10px;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: transparent;
            transition: transform 0.3s ease;
        }

        .landing-tool-icon img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }

        .landing-tool-card:hover .landing-tool-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .landing-tool-title {
            font-family: 'Fredoka', sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 1rem;
        }

        .landing-tool-description {
            color: #ffffff;
            margin-bottom: 1.5rem;
            line-height: 1.6;
            opacity: 0.9;
        }

        .landing-tool-features {
            list-style: none;
            margin-bottom: 2rem;
            text-align: left;
            max-width: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .landing-tool-features li {
            padding: 0.5rem 0;
            color: #ffffff;
            position: relative;
            padding-left: 1.5rem;
            opacity: 0.9;
        }

        .landing-tool-features li::before {
            content: '✓';
            position: absolute;
            left: 0;
            top: 0.5rem;
            color: #ffffff;
            font-weight: bold;
        }

        .landing-tool-button {
            display: inline-block;
            background: #66173D;
            color: white;
            text-decoration: none;
            padding: 1rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        .landing-tool-button:hover {
            background: #aa185f;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 23, 61, 0.4);
            color: white;
        }

        /* Footer Styles */
        .modern-footer {
            background: linear-gradient(to top, #873392, #b37ac2);
            color: white;
            padding: 3rem 2rem 1rem;
            font-family: 'Poppins', sans-serif;
            margin-top: 4rem;
        }

        .footer-main {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 2rem;
        }

        .footer-column {
            flex: 1;
            min-width: 200px;
        }

        .footer-logo-column .footer-logo {
            width: 250px;
        }

        .footer-tagline {
            font-size: 1.2rem;
            font-weight: 500;
            margin-top: 1rem;
            color: #eee;
            text-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
        }

        .footer-column h4 {
            font-size: 1.1rem;
            margin-bottom: 1rem;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
        }

        .footer-column ul li {
            margin-bottom: 0.5rem;
        }

        .footer-column ul li a {
            color: #f0e9ff;
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }

        .footer-column ul li a:hover {
            color: white;
            text-decoration: underline;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #f3eaff;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            padding-top: 1rem;
        }

        /* Responsive Styles */
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
            .tools-page-header h1 {
                font-size: 3rem;
            }
            .tools-landing-grid {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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
            .tools-page-header h1 {
                font-size: 2rem;
            }
            .tools-landing-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .landing-tool-card {
                padding: 2rem;
            }
            .user-profile {
                flex-direction: column;
                gap: 0.25rem;
            }
            .user-info {
                font-size: 0.8rem;
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
            <a href="tools.php" class="active">Tools</a>
            <a href="resources.php">Resources</a>
            <a href="about.php">About</a>
            
            <div class="user-profile">
                <div class="user-avatar"><?php echo htmlspecialchars($user_initials); ?></div>
                <div class="user-info">
                    <div class="user-name"><?php echo htmlspecialchars($user_name); ?></div>
                </div>
                <div class="dropdown-arrow">▼</div>
                <div class="user-dropdown">
                    <a href="user-profile.php">My Profile</a>
                    <a href="logout.php">Sign Out</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="main-content">
        <section class="tools-page-header">
            <h1>Your Health Tools</h1>
            <p>Access your personalized reproductive health tools and continue tracking your wellness journey</p>
        </section>

        <div class="tools-landing-grid">
            <div class="landing-tool-card">
                <div class="landing-tool-icon">
                    <img src="images/calendar.png" alt="Calendar Icon">
                </div>
                <h3 class="landing-tool-title">Ovulation Tracker</h3>
                <p class="landing-tool-description">
                    Track your menstrual cycle and predict your most fertile days with our advanced ovulation calculator.
                </p>
                <ul class="landing-tool-features">
                    <li>Ovulation predictions</li>
                    <li>Cycle history tracking</li>
                    <li>Fertility window insights</li>
                </ul>
                <a href="Tracker/ovulation-tracker.php" class="landing-tool-button">Continue Tracking</a>
            </div>

            <div class="landing-tool-card">
                <div class="landing-tool-icon">
                    <img src="images/pills.png" alt="Pills Icon">
                </div>
                <h3 class="landing-tool-title">Medication Reminder</h3>
                <p class="landing-tool-description">
                    Never miss your birth control pills or medications with our smart reminder system.
                </p>
                <ul class="landing-tool-features">
                    <li>Customizable reminder times</li>
                    <li>Missed dose tracking</li>
                    <li>Progress monitoring</li>
                </ul>
                <a href="Tracker/reminder.php" class="landing-tool-button">Manage Reminders</a>
            </div>

            <div class="landing-tool-card">
                <div class="landing-tool-icon">
                    <img src="images/baby.png" alt="Baby Icon">
                </div>
                <h3 class="landing-tool-title">Pregnancy Calculator</h3>
                <p class="landing-tool-description">
                    Calculate your due date and track your pregnancy journey with weekly updates and milestones.
                </p>
                <ul class="landing-tool-features">
                    <li>Due date calculation</li>
                    <li>Milestone tracking</li>
                    <li>Development insights</li>
                </ul>
                <a href="Tracker/due-date-calculator.php" class="landing-tool-button">View Calculator</a>
            </div>
        </div>
    </main>

    <footer class="modern-footer">
        <div class="footer-main">
            <!-- Branding -->
            <div class="footer-column footer-logo-column">
                <img src="images/whitelogo.png" alt="Planado PH Logo" class="footer-logo">
                <p class="footer-tagline">Kapag sigurado, Gawing PLANADO!</p>
            </div>

            <!-- Tools Links -->
            <div class="footer-column">
                <h4>Tools</h4>
                <ul>
                    <li><a href="Tracker/ovulation-tracker.php">Ovulation Tracker</a></li>
                    <li><a href="Tracker/reminder.php">Reminder</a></li>
                    <li><a href="Tracker/due-date-calculator.php">Due Date Calculator</a></li>
                </ul>
            </div>

            <!-- About Links -->
            <div class="footer-column">
                <h4>About</h4>
                <ul>
                    <li><a href="about.php">Our Mission</a></li>
                    <li><a href="resources.php">Resources</a></li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p>&copy; 2025 Planado PH. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>