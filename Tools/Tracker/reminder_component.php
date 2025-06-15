<?php
if (!isset($_SESSION['user_id'])) {
    return;
}
?>

<style>
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

<button class="reminder-toggle" id="reminderToggle" onclick="toggleReminderPopup()">
    💊 Reminders
</button>

<div class="reminder-popup" id="reminderPopup">
    <button class="close-popup" onclick="closeReminderPopup()">&times;</button>
    <h3>📅 Upcoming Reminders</h3>
    <div id="reminderList">
    </div>
</div>

<script>
let reminderData = [];

async function fetchReminderData() {
    try {
        const response = await fetch('<?php echo dirname($_SERVER['PHP_SELF']); ?>/fetch_cycle_data.php');
        if (response.ok) {
            const cycleData = await response.json();
            reminderData = cycleData.reminders || [];
            updateReminderButton();
        }
    } catch (error) {
        console.error('Error fetching reminder data:', error);
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

document.addEventListener('click', function(event) {
    const popup = document.getElementById('reminderPopup');
    const toggle = document.getElementById('reminderToggle');
    
    if (popup && toggle && !popup.contains(event.target) && !toggle.contains(event.target)) {
        popup.style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', function() {
    fetchReminderData();
});
</script>