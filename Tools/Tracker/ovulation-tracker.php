<?php
session_start();

require_once '../auth_check.php';
require_once '../planado_db.php';

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : null;
$initials = $user_name ? strtoupper(substr($user_name, 0, 2)) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Ovulation Tracker - All Months</title>
<link rel="stylesheet" href="../style.css">

<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background:#FDF4F5;
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
    .logo {
        display: flex;
        align-items: center;
    }

    .logo-icon {
    width: 200px;
    height: 60px;
    object-fit: contain;
    }
    
    main {
        flex-grow: 1;
        padding: 30px 40px;
        overflow-y: auto;
    }

    h1{
        text-align: center;
        color: #66173D;
        font-family: 'Fredoka', sans-serif;
        font-size: 3.5rem;
        color: #66173D;
        margin-bottom: 1rem;
        line-height: 1.2;
    }
    p {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 2rem;
        font-size: 1.1rem;
        color: #B75196;
    }

    .cycle-info {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        box-shadow: 0 0 15px rgba(162, 27, 71, 0.15);
        max-width: 800px;
        margin: 0 auto 30px;
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

    .stat-label {
        font-size: 0.9rem;
        color: #6a0d42;
        margin-top: 5px;
    }

    .year-navigation {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        margin-top: 30px;
    }

    .year-nav-btn {
        background: #8B4A9C;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        transition: background 0.3s ease;
    }

    .year-nav-btn:hover {
        background:rgb(189, 120, 206);
    }

    .year-nav-btn:disabled {
        background:rgb(204, 162, 212);
        cursor: not-allowed;
    }

    .current-year {
        font-size: 1.5rem;
        font-weight: 600;
        color: #9e1b45;
    }

    #all-months {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .month-box {
        background: #fff;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 0 0 15px rgba(162, 27, 71, 0.15);
        user-select: none;
    }

    .month-title {
        font-weight: 600;
        text-align: center;
        color: #9e1b45;
        margin-bottom: 10px;
    }

    .mini-calendar {
        display: grid;
        grid-template-columns: repeat(7, 40px); 
        grid-template-rows: auto;
        gap: 10px; 
    }

    .day-header {
        font-weight: 600;
        text-align: center;
        color: #9e1b45;
        user-select: none;
    }

    .date {
        text-align: center;
        padding: 8px 0; 
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        transition: transform 0.15s ease;
        border: 1px solid #f0b9ca;
        background-color: #fff;
        color:#66173D;
        font-size: 0.9rem; 
        user-select: none;
        width: 40px;  
        box-sizing: border-box;
        position: relative;
    }
    
    .date:hover {
        background-color: #f7c6d5;
        transform: scale(1.1);
    }
    
    .date.inactive {
        color: #d7a6b5;
        background: #fdf0f5;
        cursor: default;
    }
    
    .date.inactive:hover {
        transform: none;
        background: #fdf0f5;
    }

    .pink {
        background-color: #ffc0cb;
        color: #6a0d42;
        border: 2px solid #9e1b45;
        font-weight: 700;
    }
    .blue {
        background-color: #add8e6;
        color: #003366;
        border: 2px solid #226699;
        font-weight: 700;
    }
    .red {
        background-color: #ff7f7f;
        color: #660000;
        border: 2px solid #991111;
        font-weight: 700;
    }
    .green {
        background-color: #98fb98;
        color: #0d4d0d;
        border: 2px solid #228B22;
        font-weight: 700;
    }
    .today {
        box-shadow: 0 0 0 3px #ffd700;
    }
    .date.multi::after {
        content: '';
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #9e1b45;
    }
    .date.reminder {
    position: relative;
    border: 3px solid #FF6B35 !important;
    background: linear-gradient(135deg, #FFE5CC, #FFF0E6) !important;
    color: #D84315 !important;
    font-weight: 700 !important;
    }

    .date.reminder::before {
        content: '💊';
        position: absolute;
        top: -2px;
        left: -2px;
        font-size: 10px;
        background: #FF6B35;
        border-radius: 50%;
        width: 16px;
        height: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .reminder-toggle {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: linear-gradient(135deg, #FF6B35, #E64A19);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 15px 20px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        transition: all 0.3s ease;
        z-index: 1000;
        font-family: 'Poppins', sans-serif;
        display: none;
    }

    .reminder-toggle:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
    }

    .reminder-toggle.show {
        display: block;
    }

    .reminder-popup {
        position: fixed;
        bottom: 100px;
        right: 30px;
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        z-index: 1001;
        min-width: 300px;
        max-width: 350px;
        display: none;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .reminder-popup h3 {
        margin: 0 0 15px 0;
        color: #FF6B35;
        font-family: 'Fredoka', sans-serif;
        font-size: 1.3rem;
    }

    .reminder-item {
        background: #FFF0E6;
        border-radius: 8px;
        padding: 10px;
        margin-bottom: 10px;
        border-left: 4px solid #FF6B35;
    }

    .reminder-date {
        font-weight: 600;
        color: #D84315;
        font-size: 0.9rem;
    }

    .reminder-method {
        color: #666;
        font-size: 0.8rem;
        margin-top: 5px;
    }

    .close-popup {
        position: absolute;
        top: 10px;
        right: 15px;
        background: none;
        border: none;
        font-size: 20px;
        color: #999;
        cursor: pointer;
    }

    .no-reminders {
        text-align: center;
        color: #666;
        font-style: italic;
        padding: 20px;
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

    <?php if (isset($_SESSION['user_id'])): ?>
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
        <h1>Ovulation Tracker</h1>
        <p>The Ovulation Tracker helps you monitor your menstrual cycle and predict your most fertile days.
        By selecting the start of your last period, this tool estimates your next ovulation and menstruation dates.</p>
        
        <!-- Cycle Information Panel -->
        <div class="cycle-info" id="cycle-info" style="display: none;">
            <div class="cycle-stats" id="cycle-stats">
                <!-- Stats will be populated by JavaScript -->
            </div>
        </div>

        <!-- Legend -->
        <section aria-labelledby="legend-title" style="text-align: center; margin-bottom: 30px;">
            <ul style="display: flex; justify-content: center; gap: 20px; list-style: none; padding: 0; flex-wrap: wrap;">
                <li style="display: flex; align-items: center; gap: 8px;">
                    <span class="date pink" style="width: 20px; height: 20px; padding: 0;" aria-hidden="true"></span>
                    <span>Last menstruation</span>
                </li>
                <li style="display: flex; align-items: center; gap: 8px;">
                    <span class="date green" style="width: 20px; height: 20px; padding: 0;" aria-hidden="true"></span>
                    <span>Fertile window</span>
                </li>
                <li style="display: flex; align-items: center; gap: 8px;">
                    <span class="date blue" style="width: 20px; height: 20px; padding: 0;" aria-hidden="true"></span>
                    <span>Ovulation period</span>
                </li>
                <li style="display: flex; align-items: center; gap: 8px;">
                    <span class="date red" style="width: 20px; height: 20px; padding: 0;" aria-hidden="true"></span>
                    <span>Next menstruation</span>
                </li>
            </ul>
        </section>

        <div id="all-months"></div>
                <!-- Year Navigation -->
        <div class="year-navigation" id="year-navigation" style="display: none;">
            <button class="year-nav-btn" id="prev-year-btn" onclick="changeYear(-1)"> < </button>
            <span class="current-year" id="current-year"></span>
            <button class="year-nav-btn" id="next-year-btn" onclick="changeYear(1)"> > </button>
        </div>
        <button class="reminder-toggle" id="reminderToggle" onclick="toggleReminderPopup()">
    💊 Reminders
        </button>

        <div class="reminder-popup" id="reminderPopup">
            <button class="close-popup" onclick="closeReminderPopup()">&times;</button>
            <h3>📅 Upcoming Reminders</h3>
            <div id="reminderList">
                <!-- Reminders will be populated here -->
            </div>
        </div>
    </main>

    <script>
    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    let cycleData = null;
    let reminderData = []; 
    let currentDisplayYear = new Date().getFullYear();

    async function fetchCycleData() {
        try {
            const response = await fetch('fetch_cycle_data.php');
            if (response.ok) {
                cycleData = await response.json();
                reminderData = cycleData.reminders || [];
                updateCycleInfo();
                updateReminderButton();
                checkYearNavigation();
            } else {
                cycleData = null;
                reminderData = [];
            }
        } catch (error) {
            console.error('Error fetching cycle data:', error);
            cycleData = null;
            reminderData = [];
        }
    }
    function updateReminderButton() {
        const reminderToggle = document.getElementById('reminderToggle');
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        const nextReminder = reminderData
            .filter(reminder => {
                const reminderDate = new Date(reminder.reminder_date);
                reminderDate.setHours(0, 0, 0, 0);
                return reminderDate >= today && !reminder.is_completed;
            })
            .sort((a, b) => new Date(a.reminder_date) - new Date(b.reminder_date))[0];
        
        if (nextReminder) {
            reminderToggle.classList.add('show');
            reminderToggle.innerHTML = `💊 Reminders (1)`;
        } else {
            reminderToggle.classList.remove('show');
        }
    }

    function toggleReminderPopup() {
        const popup = document.getElementById('reminderPopup');
        const reminderList = document.getElementById('reminderList');
        
        if (popup.style.display === 'none' || popup.style.display === '') {
            populateReminderList();
            popup.style.display = 'block';
        } else {
            popup.style.display = 'none';
        }
    }
    function closeReminderPopup() {
        document.getElementById('reminderPopup').style.display = 'none';
    }

    function populateReminderList() {
        const reminderList = document.getElementById('reminderList');
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        
        const nextReminder = reminderData
            .filter(reminder => {
                const reminderDate = new Date(reminder.reminder_date);
                reminderDate.setHours(0, 0, 0, 0);
                return reminderDate >= today && !reminder.is_completed;
            })
            .sort((a, b) => new Date(a.reminder_date) - new Date(b.reminder_date))[0];
        
        if (!nextReminder) {
            reminderList.innerHTML = '<div class="no-reminders">No upcoming reminders</div>';
            return;
        }
        
        const methodNames = {
            '1': 'Daily Birth Control Pill',
            '7': 'Weekly Contraceptive Patch',
            '21': 'Birth Control Ring',
            '90': 'Depo-Provera Shot',
            '30': 'Monthly Reminder'
        };
        
        const reminderDate = new Date(nextReminder.reminder_date);
        const isToday = reminderDate.toDateString() === today.toDateString();
        const daysFromNow = Math.ceil((reminderDate - today) / (1000 * 60 * 60 * 24));
        
        let dateText = reminderDate.toLocaleDateString('en-US', { 
            weekday: 'short', 
            month: 'short', 
            day: 'numeric' 
        });
        
        if (isToday) {
            dateText += ' (Today)';
        } else if (daysFromNow === 1) {
            dateText += ' (Tomorrow)';
        } else if (daysFromNow > 1) {
            dateText += ` (in ${daysFromNow} days)`;
        }
        
        reminderList.innerHTML = `
            <div class="reminder-item">
                <div class="reminder-date">${dateText}</div>
                <div class="reminder-method">
                    ${methodNames[nextReminder.method_type] || 'Contraceptive Method'}
                    ${nextReminder.reminder_time ? `at ${nextReminder.reminder_time}` : ''}
                </div>
            </div>
        `;
    }

    function checkYearNavigation() {
        const yearNavigation = document.getElementById('year-navigation');
        const currentYearSpan = document.getElementById('current-year');
        
        if (!cycleData || !cycleData.menstruation_start) {
            yearNavigation.style.display = 'none';
            return;
        }
        
        const nextPeriodYear = new Date(cycleData.menstruation_start).getFullYear();
        const currentYear = new Date().getFullYear();
        
        if (nextPeriodYear > currentYear) {
            yearNavigation.style.display = 'flex';
        }
        
        currentYearSpan.textContent = currentDisplayYear;
        
        const prevBtn = document.getElementById('prev-year-btn');
        const nextBtn = document.getElementById('next-year-btn');
        
        prevBtn.disabled = currentDisplayYear <= currentYear;
        nextBtn.disabled = nextPeriodYear <= currentDisplayYear;
    }

    function changeYear(direction) {
        currentDisplayYear += direction;
        document.getElementById('current-year').textContent = currentDisplayYear;
        checkYearNavigation();
        renderAllMonths();
    }

    function updateCycleInfo() {
        if (!cycleData || !cycleData.last_menstruation_date) return;
        
        const cycleInfoDiv = document.getElementById('cycle-info');
        const cycleStatsDiv = document.getElementById('cycle-stats');
        
        const lastPeriod = new Date(cycleData.last_menstruation_date);
        const today = new Date();
        const daysSinceLastPeriod = Math.floor((today - lastPeriod) / (1000 * 60 * 60 * 24));

        const nextPeriod = cycleData.menstruation_start ? new Date(cycleData.menstruation_start) : null;
        const daysUntilNextPeriod = nextPeriod ? Math.floor((nextPeriod - today) / (1000 * 60 * 60 * 24)) : null;
        
        const ovulationStart = cycleData.ovulation_start ? new Date(cycleData.ovulation_start) : null;
        const daysUntilOvulation = ovulationStart ? Math.floor((ovulationStart - today) / (1000 * 60 * 60 * 24)) : null;
        
        let statsHTML = `
            <div class="stat-box">
                <span class="stat-number">${daysSinceLastPeriod}</span>
                <div class="stat-label">Days since last period</div>
            </div>
            <div class="stat-box">
                <span class="stat-number">${cycleData.cycle_length}</span>
                <div class="stat-label">Cycle length</div>
            </div>
        `;
        
        if (daysUntilNextPeriod !== null) {
            statsHTML += `
                <div class="stat-box">
                    <span class="stat-number">${daysUntilNextPeriod > 0 ? daysUntilNextPeriod : 'Today'}</span>
                    <div class="stat-label">Days until next period</div>
                </div>
            `;
        }
        
        if (daysUntilOvulation !== null) {
            statsHTML += `
                <div class="stat-box">
                    <span class="stat-number">${daysUntilOvulation > 0 ? daysUntilOvulation : (daysUntilOvulation === 0 ? 'Today' : 'Past')}</span>
                    <div class="stat-label">Days until ovulation</div>
                </div>
            `;
        }
        
        if (cycleData.statistics && cycleData.statistics.avg_cycle_length) {
            statsHTML += `
                <div class="stat-box">
                    <span class="stat-number">${cycleData.statistics.avg_cycle_length}</span>
                    <div class="stat-label">Average cycle length</div>
                </div>
            `;
        }
        
        cycleStatsDiv.innerHTML = statsHTML;
        cycleInfoDiv.style.display = 'block';
    }

    function createMiniCalendar(month, year) {
        const monthBox = document.createElement('div');
        monthBox.className = 'month-box';

        const monthTitle = document.createElement('div');
        monthTitle.className = 'month-title';
        monthTitle.textContent = new Date(year, month - 1).toLocaleString('default', { month: 'long', year: 'numeric' });
        monthBox.appendChild(monthTitle);
        
        const miniCal = document.createElement('div');
        miniCal.className = 'mini-calendar';

        days.forEach(day => {
            const dayHeader = document.createElement('div');
            dayHeader.className = 'day-header';
            dayHeader.textContent = day;
            miniCal.appendChild(dayHeader);
        });

        
        const firstDay = new Date(year, month - 1, 1).getDay();
        const daysInMonth = new Date(year, month, 0).getDate();
        const prevMonthDays = new Date(year, month - 1, 0).getDate();
        const today = new Date().toISOString().split('T')[0];

        for(let i = firstDay - 1; i >= 0; i--) {
            const inactiveBox = document.createElement('div');
            inactiveBox.className = 'date inactive';
            inactiveBox.textContent = prevMonthDays - i;
            miniCal.appendChild(inactiveBox);
        }

        for(let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${year}-${String(month).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
            const dateBox = document.createElement('div');
            dateBox.className = 'date';
            dateBox.textContent = day;

            const today = new Date();
            today.setHours(0, 0, 0, 0);

            const nextReminder = reminderData
                .filter(reminder => {
                    const reminderDate = new Date(reminder.reminder_date);
                    reminderDate.setHours(0, 0, 0, 0);
                    return reminderDate >= today && !reminder.is_completed;
                })
                .sort((a, b) => new Date(a.reminder_date) - new Date(b.reminder_date))[0];

            const hasReminder = nextReminder && nextReminder.reminder_date === dateStr;

            if (hasReminder) {
                dateBox.classList.add('reminder');
            }
            if (dateStr === today) {
                dateBox.classList.add('today');
            }

            if (cycleData) {
                if (dateStr === cycleData.last_menstruation_date) {
                    dateBox.classList.add('pink');
                }
                else if (
                    cycleData.fertile_window_start && cycleData.fertile_window_end &&
                    dateStr >= cycleData.fertile_window_start && dateStr <= cycleData.fertile_window_end
                ) {
                    dateBox.classList.add('green');
                }
                if (
                    cycleData.ovulation_start && cycleData.ovulation_end &&
                    dateStr >= cycleData.ovulation_start && dateStr <= cycleData.ovulation_end
                ) {
                    dateBox.classList.remove('green'); // Remove fertile window class
                    dateBox.classList.add('blue');
                }
                else if (
                    cycleData.menstruation_start && cycleData.menstruation_end &&
                    dateStr >= cycleData.menstruation_start && dateStr <= cycleData.menstruation_end
                ) {
                    dateBox.classList.add('red');
                }
            }

            dateBox.onclick = () => {
                saveDate(dateStr);
            };

            miniCal.appendChild(dateBox);
        }
        const totalCells = 42;
        const cellsFilled = firstDay + daysInMonth;
        for(let i = 1; i <= totalCells - cellsFilled; i++) {
            const inactiveBox = document.createElement('div');
            inactiveBox.className = 'date inactive';
            inactiveBox.textContent = i;
            miniCal.appendChild(inactiveBox);
        }

        monthBox.appendChild(miniCal);
        return monthBox;
    }

    async function saveDate(dateStr) {
        try {
            const response = await fetch('save_date.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                body: `last_date=${encodeURIComponent(dateStr)}`
            });
            
            if (response.ok) {
                const result = await response.json();
                if (result.success) {
                    await fetchCycleData();
                    renderAllMonths();
                } else {
                    alert('Failed to save date: ' + (result.error || 'Unknown error'));
                }
            } else {
                alert('Failed to save date');
            }
        } catch (error) {
            console.error('Error saving date:', error);
            alert('Failed to save date');
        }
    }

    async function renderAllMonths() {
        const container = document.getElementById('all-months');
        container.innerHTML = '';

        for(let month = 1; month <= 12; month++) {
            container.appendChild(createMiniCalendar(month, currentDisplayYear));
        }
    }

    document.addEventListener('DOMContentLoaded', async () => {
        await fetchCycleData();
        renderAllMonths();
    });

    document.addEventListener('click', function(event) {
        const popup = document.getElementById('reminderPopup');
        const toggle = document.getElementById('reminderToggle');
        
        if (!popup.contains(event.target) && !toggle.contains(event.target)) {
            popup.style.display = 'none';
        }
    });
    </script>
</body>
</html>