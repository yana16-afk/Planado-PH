<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: register.php');
    exit;
}
$name = $_SESSION['name'];
$age = $_SESSION['age'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Menstrual Calendar</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .calendar-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 800px;
            text-align: center;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .navigation button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            height: 60px;
            text-align: center;
            border: 1px solid #ccc;
            font-size: 18px;
            cursor: pointer;
        }

        .red { background-color: #ffcccc; }
        .blue { background-color: #cce5ff; }
        .white { background-color: #ffffff; }
        .selected { border: 2px solid #333; }

        .legend {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .legend div {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .legend-box {
            width: 20px;
            height: 20px;
            border: 1px solid #000;
        }

        .red-box { background-color: #ffcccc; }
        .blue-box { background-color: #cce5ff; }
    </style>
</head>
<body>
     <div style="text-align: center; margin: 20px 0;">
     <h2>Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
     <p>Age: <?php echo htmlspecialchars($age); ?></p>
     </div>
     <div class="calendar-container">
     <div class="navigation">
          <button onclick="changeMonth(-1)">Previous</button>
          <h2 id="monthTitle">Loading...</h2>
          <button onclick="changeMonth(1)">Next</button>
     </div>
     <div id="calendar"></div>

     <div class="legend">
          <div><div class="legend-box red-box"></div> Menstruation</div>
          <div><div class="legend-box blue-box"></div> Ovulation</div>
     </div>
     </div>

     <script>
     let current = new Date();
     let selectedDate = null;

     function loadCalendar(year, month, baseDate = null) {
     fetch(`fetch_calendar.php?year=${year}&month=${month}&base=${baseDate || ''}`)
          .then(res => res.text())
          .then(html => {
               document.getElementById('calendar').innerHTML = html;
               document.getElementById('monthTitle').textContent = 
                    new Date(year, month - 1).toLocaleString('default', { month: 'long', year: 'numeric' });
          });
     }

     function changeMonth(offset) {
     current.setMonth(current.getMonth() + offset);
     selectedDate = null;
     loadCalendar(current.getFullYear(), current.getMonth() + 1);
     }

     function selectDate(day) {
     selectedDate = new Date(current.getFullYear(), current.getMonth(), day);
     const formatted = selectedDate.toISOString().split('T')[0];

     // Save to DB
     fetch('save_date.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `date=${formatted}`
     })
     .then(response => response.text())
     .then(data => {
          console.log(data); // For debugging
          // Reload calendar with selected date
          loadCalendar(current.getFullYear(), current.getMonth() + 1, formatted);
     });
     }

     // Initial load
     window.onload = () => loadCalendar(current.getFullYear(), current.getMonth() + 1);
     </script>
</body>
</html>
