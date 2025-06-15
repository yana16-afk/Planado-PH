<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Terms and Conditions - Planado PH</title>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500&display=swap" rel="stylesheet" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Fredoka', sans-serif;
      background: linear-gradient(135deg, #ffe6f0, #e6f9ff);
      min-height: 100vh;
      overflow-x: hidden;
      position: relative;
      padding: 60px 20px;
    }

    .container {
      max-width: 700px;
      margin: auto;
      background: #ffffffee;
      border-radius: 24px;
      box-shadow: 0 10px 30px rgba(190, 150, 200, 0.2);
      padding: 40px;
      position: relative;
      z-index: 2;
    }

    h1 {
      text-align: center;
      color: #d279a6;
      margin-bottom: 20px;
      font-size: 2rem;
    }

    p {
      font-size: 1rem;
      color: #444;
      margin-bottom: 16px;
      line-height: 1.8;
    }

    .floating-shape {
      position: absolute;
      width: 60px;
      height: 60px;
      background: rgba(255, 255, 255, 0.4);
      border-radius: 50%;
      box-shadow: 0 0 10px rgba(255, 200, 240, 0.6);
      animation: float 6s ease-in-out infinite;
      z-index: 1;
    }

    .shape1 {
      top: 10%;
      left: 5%;
      background-image: url('images/pill.png');
      background-size: contain;
      background-repeat: no-repeat;
    }

    .shape2 {
      bottom: 15%;
      right: 8%;
      background-image: url('images/heart.png');
      background-size: contain;
      background-repeat: no-repeat;
    }

    .shape3 {
      top: 50%;
      right: 12%;
      background-image: url('images/cross.png');
      background-size: contain;
      background-repeat: no-repeat;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0px);
      }
      50% {
        transform: translateY(-15px);
      }
    }

    .back-button {
      display: block;
      margin: 40px auto 0;
      padding: 12px 28px;
      font-size: 1rem;
      font-weight: 500;
      color: white;
      background-color: #e493b3;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      text-align: center;
      transition: background-color 0.3s ease;
      text-decoration: none;
      max-width: 200px;
      box-shadow: 0 4px 12px rgba(222, 130, 170, 0.3);
    }

    .back-button:hover {
      background-color: #cc7da3;
    }
  </style>
</head>
<body>

  <!-- Floating Shapes -->
  <div class="floating-shape shape1"></div>
  <div class="floating-shape shape2"></div>
  <div class="floating-shape shape3"></div>

  <!-- Main Terms Content -->
  <div class="container">
    <h1>Terms & Conditions</h1>
    <p>By registering on <strong>Planado PH</strong>, you agree to our data privacy policy and user agreement. This platform is designed for educational and wellness tracking purposes.</p>
    <p>Your personal information will only be used to provide you with cycle reminders, contraceptive education, and pregnancy planning tools. We ensure encryption and responsible data handling, and do not share your data with third parties.</p>
    <p>This service is not a substitute for medical advice. Always consult a licensed healthcare provider for any personal health concerns or diagnosis.</p>
    <p>By clicking "I accept the Terms & Conditions", you acknowledge these statements and consent to the responsible use of your data within Planado PH.</p>

    <a class="back-button" href="register.php">← Back to Register</a>
  </div>

</body>
</html>
