<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Ovulation Tracker - All Months</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
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

    main {
        flex-grow: 1;
        padding: 30px 40px;
        overflow-y: auto;
    }

    h1{
        text-align: center;
        margin-bottom: 20px;
        font-size: 2.5rem;
        color: #66173D;
    }
    .banner p {
        font-size: 1.3rem;
        color: #B75196;
        margin-bottom: 2rem;
        line-height: 1.5;
        padding: 0 20px;
        text-align: center;
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
    </style>
</head>
<body>
    <header class="header">
            <div class="logo">
        <img src="../images/logo.png" alt="Logo" class="logo-icon">
        </div>
        <nav class="nav">
            <a href="../index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a>
            <a href="calendar.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'calendar.php' ? 'active' : ''; ?>">Ovulation Tracker</a>
            <a href="due-date-calculator.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'due-date-calculator.php' ? 'active' : ''; ?>">Due-date Calculator</a>
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
    </main>

    <script>
    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    let cycleData = null;
    let currentDisplayYear = new Date().getFullYear();
    
    async function fetchCycleData() {
        try {
            const response = await fetch('fetch_cycle_data.php');
            if (response.ok) {
                cycleData = await response.json();
                updateCycleInfo();
                checkYearNavigation();
            } else {
                cycleData = null;
            }
        } catch (error) {
            console.error('Error fetching cycle data:', error);
            cycleData = null;
        }
    }

    function checkYearNavigation() {
        const yearNavigation = document.getElementById('year-navigation');
        const currentYearSpan = document.getElementById('current-year');
        
        if (!cycleData || !cycleData.menstruation_start) {
            yearNavigation.style.display = 'none';
            return;
        }
        
        // Check if next period extends to next year
        const nextPeriodYear = new Date(cycleData.menstruation_start).getFullYear();
        const currentYear = new Date().getFullYear();
        
        if (nextPeriodYear > currentYear) {
            yearNavigation.style.display = 'flex';
        }
        
        currentYearSpan.textContent = currentDisplayYear;
        
        // Update button states
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
        
        // Calculate days since last period
        const lastPeriod = new Date(cycleData.last_menstruation_date);
        const today = new Date();
        const daysSinceLastPeriod = Math.floor((today - lastPeriod) / (1000 * 60 * 60 * 24));
        
        // Calculate days until next period
        const nextPeriod = cycleData.menstruation_start ? new Date(cycleData.menstruation_start) : null;
        const daysUntilNextPeriod = nextPeriod ? Math.floor((nextPeriod - today) / (1000 * 60 * 60 * 24)) : null;
        
        // Calculate days until ovulation
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

        // Previous month inactive days
        for(let i = firstDay - 1; i >= 0; i--) {
            const inactiveBox = document.createElement('div');
            inactiveBox.className = 'date inactive';
            inactiveBox.textContent = prevMonthDays - i;
            miniCal.appendChild(inactiveBox);
        }

        // Current month days
        for(let day = 1; day <= daysInMonth; day++) {
            const dateStr = `${year}-${String(month).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
            const dateBox = document.createElement('div');
            dateBox.className = 'date';
            dateBox.textContent = day;

            // Mark today
            if (dateStr === today) {
                dateBox.classList.add('today');
            }

            if (cycleData) {
                // Last menstruation date
                if (dateStr === cycleData.last_menstruation_date) {
                    dateBox.classList.add('pink');
                }
                // Fertile window
                else if (
                    cycleData.fertile_window_start && cycleData.fertile_window_end &&
                    dateStr >= cycleData.fertile_window_start && dateStr <= cycleData.fertile_window_end
                ) {
                    dateBox.classList.add('green');
                }
                // Ovulation period (priority over fertile window for display)
                if (
                    cycleData.ovulation_start && cycleData.ovulation_end &&
                    dateStr >= cycleData.ovulation_start && dateStr <= cycleData.ovulation_end
                ) {
                    dateBox.classList.remove('green'); // Remove fertile window class
                    dateBox.classList.add('blue');
                }
                // Next menstruation period
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

        // Next month inactive days
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
    </script>
</body>
</html>