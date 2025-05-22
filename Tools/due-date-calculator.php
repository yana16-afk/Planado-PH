<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>

<!--DRAFT LANG TOOOOOOOOOOOOOOOOOOOOOO -->
<!--DRAFT LANG TOOOOOOOOOOOOOOOOOOOOOO -->
<!--DRAFT LANG TOOOOOOOOOOOOOOOOOOOOOO -->
<!--DRAFT LANG TOOOOOOOOOOOOOOOOOOOOOO -->
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <title>Pregnancy Due Date Calculator</title>
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
     <style>
     body {
          margin: 0; 
          font-family: 'Poppins', sans-serif;
          background: #fff0f6;
          color: #6a0d42;
          display: flex;
          min-height: 100vh;
     }
     nav {
          width: 220px;
          background: #ffcad4;
          padding: 20px;
          display: flex;
          flex-direction: column;
          gap: 20px;
          border-right: 2px solid #f28ab2;
     }
     nav h2 {
          margin: 0 0 20px;
          font-weight: 600;
          color: #9e1b45;
     }
     nav a {
          text-decoration: none;
          color: #6a0d42;
          font-weight: 600;
          padding: 10px 15px;
          border-radius: 8px;
          transition: background 0.3s ease;
     }
     nav a:hover, nav a.active {
          background: #f28ab2;
          color: #fff;
     }

     main {
          flex-grow: 1;
          padding: 30px 40px;
     }

     h1 {
          margin-bottom: 20px;
     }

     input, button {
          font-family: 'Poppins', sans-serif;
          padding: 10px;
          border-radius: 8px;
          border: 2px solid #f28ab2;
          outline: none;
          font-size: 1rem;
          margin-top: 10px;
     }

     input {
          width: 250px;
          color: #6a0d42;
          background: #fff0f6;
     }

     button {
          background: #f28ab2;
          color: white;
          cursor: pointer;
          border: none;
          transition: background 0.3s ease;
          margin-left: 10px;
     }

     button:hover {
          background: #9e1b45;
     }

     #result {
          margin-top: 25px;
          font-weight: 600;
          font-size: 1.1rem;
          color: #9e1b45;
     }
     </style>
</head>
<body>
     <nav>
          <h2>Menu</h2>
          <a href="calendar.php">Ovulation Tracker</a>
          <a href="due-date-calculator.php" class="active">Pregnancy Due Date Calculator</a>
          <a href="logout.php">Logout</a>
     </nav>

     <main>
          <h1>Pregnancy Due Date Calculator</h1>
          <label for="lmp">Last Menstrual Period (LMP):</label><br/>
          <input type="date" id="lmp" name="lmp" max="<?= date('Y-m-d') ?>" />
          <button onclick="calculateDueDate()">Calculate</button>

          <div id="result"></div>
     </main>

     <script>
     function calculateDueDate() {
          const lmpInput = document.getElementById('lmp').value;
          if (!lmpInput) {
          alert('Please select your last menstrual period date.');
          return;
          }
          const lmpDate = new Date(lmpInput);
          const dueDate = new Date(lmpDate.getTime() + 280 * 24 * 60 * 60 * 1000);

          const options = { year: 'numeric', month: 'long', day: 'numeric' };
          document.getElementById('result').textContent = 'Estimated Due Date: ' + dueDate.toLocaleDateString(undefined, options);
     }
     </script>
</body>
</html>
