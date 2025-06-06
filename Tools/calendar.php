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
        overflow-y: auto;
    }

    h1 {
        margin-bottom: 30px;
        display: flex; 
        justify-content: center;
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
    color: #6a0d42;
    font-size: 0.9rem; 
    user-select: none;
    width: 40px;  
    box-sizing: border-box;
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
    </style>
</head>
<body>
    <nav>
        <h2>Menu</h2>
        <a href="calendar.php" class="active">Ovulation Tracker</a>
        <a href="due-date-calculator.php">Pregnancy Due Date Calculator</a>
        <a href="logout.php">Logout</a>
    </nav>
    <main>
        <h1>Ovulation Tracker</h1>
        <!-- Semantic Legend -->
        <section aria-labelledby="legend-title" style="text-align: center; margin-bottom: 30px;">
            <ul style="display: flex; justify-content: center; gap: 30px; list-style: none; padding: 0; flex-wrap: wrap;">
            <li style="display: flex; align-items: center; gap: 8px;">
                <span class="date pink" style="width: 20px; height: 20px; padding: 0;" aria-hidden="true"></span>
                <span>Last menstruation date</span>
            </li>
            <li style="display: flex; align-items: center; gap: 8px;">
                <span class="date blue" style="width: 20px; height: 20px; padding: 0;" aria-hidden="true"></span>
                <span>Ovulation period</span>
            </li>
            <li style="display: flex; align-items: center; gap: 8px;">
                <span class="date red" style="width: 20px; height: 20px; padding: 0;" aria-hidden="true"></span>
                <span>Next menstruation period</span>
            </li>
            </ul>
        </section>

        <div id="all-months"></div>
    </main>

    <script>
    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    let cycleData = null;
    async function fetchCycleData() {
        const response = await fetch('fetch_cycle_data.php');
        if (response.ok) {
        cycleData = await response.json();
        } else {
        cycleData = null;
        }
    }

    function createMiniCalendar(month, year) {
        const monthBox = document.createElement('div');
        monthBox.className = 'month-box';

        const monthTitle = document.createElement('div');
        monthTitle.className = 'month-title';
        monthTitle.textContent = new Date(year, month -1).toLocaleString('default', { month: 'long', year: 'numeric' });
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

        if (cycleData) {
            if (dateStr === cycleData.last_menstruation_date) {
            dateBox.classList.add('pink');
            } else if (
            cycleData.ovulation_start && cycleData.ovulation_end &&
            dateStr >= cycleData.ovulation_start && dateStr <= cycleData.ovulation_end
            ) {
            dateBox.classList.add('blue');
            } else if (
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
        for(let i=1; i <= totalCells - cellsFilled; i++) {
        const inactiveBox = document.createElement('div');
        inactiveBox.className = 'date inactive';
        inactiveBox.textContent = i;
        miniCal.appendChild(inactiveBox);
        }

        monthBox.appendChild(miniCal);
        return monthBox;
    }

    async function saveDate(dateStr) {
        const response = await fetch('save_date.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `last_date=${encodeURIComponent(dateStr)}`
        });
        if (response.ok) {
        await fetchCycleData();
        renderAllMonths();
        } else {
        alert('Failed to save date');
        }
    }

    async function renderAllMonths() {
        const container = document.getElementById('all-months');
        container.innerHTML = '';
        const now = new Date();
        const year = now.getFullYear();

        for(let month=1; month <= 12; month++) {
        container.appendChild(createMiniCalendar(month, year));
        }
    }

    document.addEventListener('DOMContentLoaded', async () => {
        await fetchCycleData();
        renderAllMonths();
    });
    </script>
</body>
</html>
