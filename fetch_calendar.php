<?php
require 'db.php';
session_start();

$user_id = $_SESSION['user_id'] ?? 1; 

$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$baseDate = null;

if (!empty($_GET['base'])) {
    $baseDate = new DateTime($_GET['base']);
} else {
    $stmt = $pdo->prepare("SELECT last_menstruation_date FROM user_menstruation WHERE user_id = :uid");
    $stmt->execute(['uid' => $user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        $baseDate = new DateTime($row['last_menstruation_date']);
    }
}

$firstDay = new DateTime("$year-$month-01");
$startWeekday = (int)$firstDay->format('w'); // Sunday = 0
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

$menstruation = [];
$ovulation = [];

if ($baseDate) {
    $cycleLength = 28;
    $menstruationLength = 5;
    $ovulationStartDay = 14;
    $ovulationWindow = 3;

    $nextMenstruationStart = (clone $baseDate)->modify("+$cycleLength days");
    $nextMenstruationEnd = (clone $nextMenstruationStart)->modify("+" . ($menstruationLength - 1) . " days");

    $ovulationStart = (clone $baseDate)->modify("+$ovulationStartDay days");
    $ovulationEnd = (clone $ovulationStart)->modify("+" . ($ovulationWindow - 1) . " days");

    while ($nextMenstruationStart <= $nextMenstruationEnd) {
        if ($nextMenstruationStart->format('Y-m') === sprintf('%04d-%02d', $year, $month)) {
            $menstruation[] = (int)$nextMenstruationStart->format('j');
        }
        $nextMenstruationStart->modify('+1 day');
    }

    while ($ovulationStart <= $ovulationEnd) {
        if ($ovulationStart->format('Y-m') === sprintf('%04d-%02d', $year, $month)) {
            $ovulation[] = (int)$ovulationStart->format('j');
        }
        $ovulationStart->modify('+1 day');
    }
}

echo "<table><tr>";
$days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
foreach ($days as $d) echo "<th>$d</th>";
echo "</tr><tr>";

for ($i = 0; $i < $startWeekday; $i++) echo "<td class='white'></td>";

for ($day = 1; $day <= $daysInMonth; $day++) {
    $class = 'white';
    if (in_array($day, $menstruation)) {
        $class = 'red';
    } elseif (in_array($day, $ovulation)) {
        $class = 'blue';
    }

    echo "<td class='$class' onclick='selectDate($day)'>$day</td>";

    if (($startWeekday + $day) % 7 == 0) echo "</tr><tr>";
}

echo "</tr></table>";
