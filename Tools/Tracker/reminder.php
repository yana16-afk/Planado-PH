<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Contraceptive Reminder - Planado</title>
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

h1 {
    text-align: center;
    color: #66173D;
    font-family: 'Fredoka', sans-serif;
    font-size: 3.5rem;
    margin-bottom: 1rem;
    line-height: 1.2;
}

.subtitle {
    text-align: center;
    max-width: 800px;
    margin: 0 auto 2rem;
    font-size: 1.1rem;
    color: #B75196;
}

.reminder-container {
    max-width: 600px;
    margin: 2rem auto;
    background: white;
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: 0 0 15px rgba(162, 27, 71, 0.15);
}

.reminder-container h2 {
    color: #66173D;
    font-family: 'Fredoka', sans-serif;
    font-size: 2rem;
    margin-bottom: 1.5rem;
    text-align: center;
}

.form-group {
    margin-bottom: 1.5rem;
}

label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #66173D;
}

select, input {
    width: 100%;
    padding: 0.8rem;
    border: 2px solid #f0b9ca;
    border-radius: 10px;
    font-size: 1rem;
    font-family: 'Poppins', sans-serif;
    background: white;
    color: #66173D;
    transition: border-color 0.3s ease;
}

select:focus, input:focus {
    outline: none;
    border-color: #B75196;
}

.btn-primary {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #B75196, #8B4A9C);
    color: white;
    font-weight: 600;
    border: none;
    border-radius: 10px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    margin-top: 1rem;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(183, 81, 150, 0.3);
}

.btn-primary:disabled {
    background: #ccc;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.output {
    margin-top: 2rem;
    background: linear-gradient(135deg, #f7e6f0, #fdf0f5);
    padding: 1.5rem;
    border-radius: 12px;
    text-align: center;
    font-weight: 500;
    color: #66173D;
    border: 2px solid #f0b9ca;
}

.output h3 {
    margin: 0 0 1rem 0;
    color: #B75196;
    font-family: 'Fredoka', sans-serif;
}

.reminder-date {
    font-size: 1.2rem;
    font-weight: 600;
    color: #66173D;
    margin: 1rem 0;
}

.view-calendar-btn {
    background: linear-gradient(135deg, #8B4A9C, #6B3A7C);
    color: white;
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    margin-top: 1rem;
    transition: transform 0.2s ease;
}

.view-calendar-btn:hover {
    transform: translateY(-1px);
}

.loading {
    display: none;
    text-align: center;
    color: #B75196;
}

@media screen and (max-width: 768px) {
    .header {
        padding: 1rem 2rem;
    }
    
    main {
        padding: 20px;
    }
    
    h1 {
        font-size: 2.5rem;
    }
    
    .reminder-container {
        margin: 1rem;
        padding: 1.5rem;
    }
}
</style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="../images/logo.png" alt="Logo" class="logo-icon">
        </div>
        <nav class="nav">
            <a href="../index.php">Home</a>
            <a href="ovulation-tracker.php">Ovulation Tracker</a>
            <a href="reminder.php" class="active">Contraceptive Reminder</a>
            <a href="due-date-calculator.php">Due-date Calculator</a>
        </nav>
    </header>

    <main>
        <h1>Contraceptive Reminder</h1>
        <p class="subtitle">Never miss a dose! Set up your personalized reminder schedule and stay consistent with your contraceptive method for maximum protection.</p>

        <div class="reminder-container">
            <h2>📅 Set Your Reminder</h2>
            
            <form id="reminderForm">
                <div class="form-group">
                    <label for="method">Select Your Contraceptive Method</label>
                    <select id="method" required>
                        <option value="">Choose your method...</option>
                        <option value="1">Daily Birth Control Pill</option>
                        <option value="7">Weekly Contraceptive Patch</option>
                        <option value="21">Birth Control Ring (3 weeks)</option>
                        <option value="90">Depo-Provera Shot (3 months)</option>
                        <option value="30">Monthly Reminder</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="startDate">When did you last take/apply your method?</label>
                    <input type="date" id="startDate" max="<?php echo date('Y-m-d'); ?>" required />
                </div>

                <div class="form-group">
                    <label for="reminderTime">Preferred reminder time (optional)</label>
                    <input type="time" id="reminderTime" value="09:00" />
                </div>

                <button type="submit" class="btn-primary" id="submitBtn">
                    Set My Reminder 🔔
                </button>
            </form>

            <div class="loading" id="loading">
                <p>Setting up your reminder...</p>
            </div>

            <div class="output" id="output" style="display:none;">
            </div>
        </div>
    </main>

    <script>
    document.getElementById('reminderForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const method = document.getElementById('method').value;
        const startDate = document.getElementById('startDate').value;
        const reminderTime = document.getElementById('reminderTime').value;
        
        if (!method || !startDate) {
            alert('Please fill in all required fields.');
            return;
        }
        
        document.getElementById('loading').style.display = 'block';
        document.getElementById('submitBtn').disabled = true;
        
        try {
            const response = await fetch('save_reminder.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `method=${encodeURIComponent(method)}&start_date=${encodeURIComponent(startDate)}&reminder_time=${encodeURIComponent(reminderTime)}`
            });
            
            const result = await response.json();
            
            if (result.success) {
                showReminderResult(result.data);
            } else {
                alert('Error: ' + (result.error || 'Failed to set reminder'));
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Failed to set reminder. Please try again.');
        } finally {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('submitBtn').disabled = false;
        }
    });
    
    function showReminderResult(data) {
        const methodNames = {
            '1': 'Daily Birth Control Pill',
            '7': 'Weekly Contraceptive Patch', 
            '21': 'Birth Control Ring',
            '90': 'Depo-Provera Shot',
            '30': 'Monthly Reminder'
        };
        
        const nextDate = new Date(data.next_reminder_date);
        const options = { 
            weekday: 'long',
            year: 'numeric', 
            month: 'long', 
            day: 'numeric' 
        };
        const formattedDate = nextDate.toLocaleDateString('en-US', options);
        
        document.getElementById('output').innerHTML = `
            <h3>✅ Reminder Set Successfully!</h3>
            <div class="reminder-date">
                <strong>Next ${methodNames[data.method_type]}:</strong><br>
                ${formattedDate}
                ${data.reminder_time ? `<br><small>at ${data.reminder_time}</small>` : ''}
            </div>
            <p>Your reminder has been saved and will appear on your calendar.</p>
            <a href="ovulation-tracker.php" class="view-calendar-btn">
                📅 View on Calendar
            </a>
        `;
        
        document.getElementById('output').style.display = 'block';
    }
    
    document.getElementById('startDate').max = new Date().toISOString().split('T')[0];
    </script>
</body>
</html>