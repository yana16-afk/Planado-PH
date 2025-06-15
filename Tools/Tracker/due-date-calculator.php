<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
function ordinal($n) {
    $v = $n % 100;
    if ($v >= 11 && $v <= 13) return $n . 'th';
    switch ($n % 10) {
        case 1: return $n . 'st';
        case 2: return $n . 'nd';
        case 3: return $n . 'rd';
        default: return $n . 'th';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Due Date Calculator</title>
  <link rel="stylesheet" href="../style.css">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #FDF4F5;
      margin: 0;
      padding: 0;
      color: #66173D;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 4rem;
      background: #BA90C6;
    }
    .logo img {
      height: 60px;
    }
    
    main {
      padding: 2rem 4rem;
      max-width: 1200px;
      margin: 0 auto;
    }
    h1{
      text-align: center;
      color: #66173D;
      font-family: 'Fredoka', sans-serif;
      font-size: 3.5rem;
      color: #66173D;
      margin-bottom: 2rem;
      line-height: 1.2;
    }
    p {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 2rem;
        font-size: 1.1rem;
        color: #B75196;
    }
    
    .content-container {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2rem;
      align-items: start;
    }
    
    .calculator-section {
      background: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      height: fit-content;
    }
    
    .summary-section {
      background: #fff;
      border-radius: 12px;
      padding: 2rem;
      box-shadow: 0 0 15px rgba(162, 27, 71, 0.15);
      height: fit-content;
    }
    
    .calculator-section h2 {
      color: #66173D;
      font-family: 'Fredoka', sans-serif;
      font-size: 1.8rem;
      margin-bottom: 1.5rem;
      text-align: center;
    }
    
    .summary-section h2 {
      color: #66173D;
      font-family: 'Fredoka', sans-serif;
      font-size: 1.8rem;
      margin-bottom: 1.5rem;
      text-align: center;
    }
    
    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
    }
    select, button {
      font-family: 'Fredoka', sans-serif;
      width: 100%;
      padding: 0.75rem;
      margin-bottom: 1.5rem;
      font-size: 1rem;
      border-radius: 25px;
      border: 1px solid #ccc;
      color: #66173D;

    }
    button {
      background: #66173D;
      color: white;
      padding: 1rem 2rem;
      border-radius: 25px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      font-size: 1.1rem;
      transition: all 0.3s ease;
    }
    button:hover {
      background: #aa185f;
    }
    .info-msg {
      background: #fce3f3;
      color: #9e1b45;
      text-align: center;
      padding: 1rem;
      border-radius: 8px;
      display: none;
      margin-top: 10px;
    }
    .cycle-stats {
      display: grid;
      grid-template-columns: 1fr;
      gap: 15px;
      margin-bottom: 20px;
    }
    .stat-box {
      text-align: center;
      padding: 15px;
      background: #fef7f8;
      border-radius: 8px;
      border: 1px solid #f7c6d5;
    }
    .stat-number {
      font-size: 1.3rem;
      font-weight: 600;
      color: #9e1b45;
      display: block;
    }
    .stat-label {
      font-size: 0.9rem;
      color: #6a0d42;
      margin-top: 5px;
    }
    #deleteModal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.4);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    #deleteModal > div {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      text-align: center;
      max-width: 400px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    .no-data-message {
      text-align: center;
      color: #B75196;
      font-style: italic;
      padding: 20px;
    }
    .delete-section {
      text-align: center;
      display: none;
      
    }
    .delete-section.show {
      display: block;
    }

    #delete-due-date {
      background: #66173D;
      color: white;
      padding: 1rem 2rem;
      border-radius: 25px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      width: 100%;
      margin-top: 1rem;
    }
    #delete-due-date:hover {
      background: #aa185f;
    }

    @media (max-width: 768px) {
      .content-container {
        grid-template-columns: 1fr;
        gap: 1.5rem;
      }
      
      main {
        padding: 1rem 2rem;
      }
      
      .header {
        padding: 1rem 2rem;
      }
      
      h1 {
        font-size: 2.5rem;
      }
      
      .calculator-section h2,
      .summary-section h2 {
        font-size: 1.5rem;
      }
      
      .cycle-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
      }
      
      .stat-box {
        text-align: center;
        padding: 15px;
        background: #fef7f8;
        border-radius: 8px;
        border: 1px solid #f7c6d5;
      }
      
      .stat-number {
        font-size: 1.5rem;
        font-weight: 600;
        color: #9e1b45;
        display: block;
      }
    }
    
    @media (max-width: 480px) {
      .nav {
        flex-direction: column;
        gap: 1rem;
      }
      
      .nav a {
        font-size: 1.1rem;
      }
      
      h1 {
        font-size: 2rem;
      }
      
      .calculator-section,
      .summary-section {
        padding: 1.5rem;
      }
    }
    .cancel-btn {
      background: rgb(140, 91, 115);
      color: white;
      padding: 1rem 2rem;
      border-radius: 25px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      font-size: 1.1rem;
      transition: all 0.3s ease;
    }

    .cancel-btn:hover {
      background: rgb(100, 65, 85); /* Darker on hover */
    }
  </style>
</head>
<body>





<header class="header">
  <div class="logo">
    <a href="../index.php">
      <img src="../images/logo.png" class="logo-icon" alt="Planado PH Logo">
    </a>
  </div>
  <nav class="nav">
    <a href="../index.php">Home</a>
    <a href="../tools.php">Tools</a>
    <a href="../resources.php">Resources</a>
    <a href="../about.php">About</a>

    <?php if (isset($_SESSION['user_id'])): 
      $user_name = $_SESSION['user_name'];
      $initials = strtoupper(substr($user_name, 0, 2));
    ?>
      <div class="user-profile">
        <div class="user-avatar"><?= htmlspecialchars($initials) ?></div>
        <div class="user-name"><?= htmlspecialchars($user_name) ?></div>
        <div class="dropdown-arrow">▼</div>
        <div class="user-dropdown">
          <a href="../user-profile.php">My Profile</a>
          <a href="../logout.php">Sign Out</a>
        </div>
      </div>
    <?php else: ?>
      <a href="../login.php" class="sign-in-btn">Sign In</a>
    <?php endif; ?>
  </nav>
</header>


  <main>
    <h1>Pregnancy Due Date Calculator</h1>
    <p>
      This tool helps expectant parents estimate their baby's due date based on the conception timeframe. 
      By selecting the approximate week of conception, you'll receive a projected due date along with a pregnancy timeline summary.
    </p>

    <div class="content-container">

      <div class="calculator-section">
        <h2>Calculate Your Due Date</h2>
        
        <form id="dueDateForm">
          <label for="year">Select Year:</label>
          <select id="year" name="year" required>
            <?php for ($y = date('Y'); $y <= date('Y') + 2; $y++): ?>
              <option value="<?= $y ?>"><?= $y ?></option>
            <?php endfor; ?>
          </select>

          <label for="month">Select Month:</label>
          <select id="month" name="month" required>
            <?php foreach (range(1, 12) as $m): ?>
              <option value="<?= $m ?>"><?= date('F', mktime(0, 0, 0, $m, 10)) ?></option>
            <?php endforeach; ?>
          </select>

          <label for="week">Select Week of the Month:</label>
          <select id="week" name="week" required>
            <option value="1">1st Week</option>
            <option value="2">2nd Week</option>
            <option value="3">3rd Week</option>
            <option value="4">4th Week</option>
            <option value="5">5th Week</option>
          </select>

          <button type="submit">Calculate Due Date</button>
        </form>

        <div class="info-msg" id="msg-box"></div>
      </div>

      <div class="summary-section">
        <h2>Pregnancy Summary</h2>
        
        <div class="cycle-stats" id="due-stats">
          <div class="no-data-message">
            <p>No due date data available.</p>
            <p>Calculate your due date to see your pregnancy summary.</p>
          </div>
        </div>
        
        <div class="delete-section" id="delete-section">
          <button id="delete-due-date">
            Delete Due Date
          </button>
        </div>
      </div>
    </div>
  </main>

  <div id="deleteModal">
    <div>
      <p>Are you sure you want to delete your saved due date?</p>
      <button id="confirmDelete">Yes, Delete</button>
      <button id="cancelDelete" class="cancel-btn">Cancel</button>
    </div>
  </div>

  <script>
    function formatDate(date) {
      return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    }

    function renderStatsPanel(dueDate) {
      const today = new Date();
      const due = new Date(dueDate);
      const daysRemaining = Math.floor((due - today) / (1000 * 60 * 60 * 24));
      const weeksPregnant = Math.max(1, 40 - Math.ceil(daysRemaining / 7));
      const trimester = weeksPregnant < 13 ? '1st' : (weeksPregnant < 27 ? '2nd' : '3rd');
      const rangeStart = new Date(due); rangeStart.setDate(rangeStart.getDate() - 7);
      const rangeEnd = new Date(due); rangeEnd.setDate(rangeEnd.getDate() + 7);

      document.getElementById('due-stats').innerHTML = `
        <div class="stat-box"><span class="stat-number">${formatDate(due)}</span><div class="stat-label">Expected Due Date</div></div>
        <div class="stat-box"><span class="stat-number">${rangeStart.toLocaleDateString(undefined, { month: 'short', day: 'numeric' })} – ${rangeEnd.toLocaleDateString(undefined, { month: 'short', day: 'numeric' })}</span><div class="stat-label">Due Range</div></div>
        <div class="stat-box"><span class="stat-number">${weeksPregnant}</span><div class="stat-label">Weeks Pregnant</div></div>
        <div class="stat-box"><span class="stat-number">${daysRemaining >= 0 ? daysRemaining : 'Overdue'}</span><div class="stat-label">Days Remaining</div></div>
        <div class="stat-box"><span class="stat-number">${trimester}</span><div class="stat-label">Trimester</div></div>
      `;
      document.getElementById('delete-section').classList.add('show');
    }

    function showNoDataMessage() {
      document.getElementById('due-stats').innerHTML = `
        <div class="no-data-message">
          <p>No due date data available.</p>
          <p>Calculate your due date to see your pregnancy summary.</p>
        </div>
      `;
      document.getElementById('delete-section').classList.remove('show');
    }

    function showMessage(text, isError = false) {
      const box = document.getElementById('msg-box');
      box.textContent = text;
      box.style.display = 'block';
      box.style.backgroundColor = isError ? '#fce3e3' : '#fce3f3';
      box.style.color = isError ? '#d32f2f' : '#9e1b45';
      setTimeout(() => box.style.display = 'none', 4000);
    }

    async function loadSavedDueDate() {
      try {
        const res = await fetch('fetch_due_date.php');
        const data = await res.json();

        if (data.success && data.due_date) {
          renderStatsPanel(data.due_date);
        } else {
          showNoDataMessage();
        }
      } catch (error) {
        console.error('Error loading due date:', error);
        showNoDataMessage();
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      loadSavedDueDate();

      document.getElementById('dueDateForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        try {
          const year = +document.getElementById('year').value;
          const month = +document.getElementById('month').value;
          const week = +document.getElementById('week').value;

          const conception = new Date(year, month - 1, (week - 1) * 7 + 1);
          const dueDate = new Date(conception);
          dueDate.setDate(dueDate.getDate() + 280);

          const save = await fetch('save_due_date.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `due_date=${dueDate.toISOString().split('T')[0]}`
          }).then(r => r.json());

          if (save.success) {
            renderStatsPanel(dueDate);
            showMessage('Due date saved successfully.');
          } else {
            showMessage(save.error || 'Error saving due date.', true);
          }
        } catch (error) {
          console.error('Error calculating due date:', error);
          showMessage('Error calculating due date.', true);
        }
      });
      document.getElementById('delete-due-date').onclick = () => {
        document.getElementById('deleteModal').style.display = 'flex';
      };
      
      document.getElementById('cancelDelete').onclick = () => {
        document.getElementById('deleteModal').style.display = 'none';
      };
      
      document.getElementById('confirmDelete').onclick = async () => {
        try {
          const res = await fetch('delete_due_date.php', { method: 'POST' });
          const data = await res.json();
          
          if (data.success) {
            showNoDataMessage();
            showMessage('Due date deleted successfully.');
          } else {
            showMessage(data.error || 'Error deleting due date.', true);
          }
        } catch (error) {
          console.error('Error deleting due date:', error);
          showMessage('Error deleting due date.', true);
        }
        
        document.getElementById('deleteModal').style.display = 'none';
      };
      document.getElementById('deleteModal').onclick = (e) => {
        if (e.target === document.getElementById('deleteModal')) {
          document.getElementById('deleteModal').style.display = 'none';
        }
      };
    });
  </script>
</body>
</html>