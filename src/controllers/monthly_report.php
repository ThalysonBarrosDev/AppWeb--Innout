<?php

    session_start();
    requireValidSession();

    $currentdate = new DateTime();

    $user = $_SESSION['user'];
    $registries = WorkingHours::getMonthlyReport($user->id, $currentdate);

    $report = [];
    $workday = 0;
    $sumofworkedtime = 0;
    $lastday = getLastDayOfMonth($currentdate)->format('d');

    for ($day = 1; $day <= $lastday; $day++) {

        $date = $currentdate->format('Y-m') . '-' . sprintf('%02d', $day);
        $registry = $registries[$date];

        if (isPastWorkday($date)) { $workday++; }

        if ($registry) {

            $sumofworkedtime += $registry->worked_time;
            array_push($report, $registry);

        } else {

            array_push($report, new WorkingHours(['work_date' => $date, 'worked_time' => 0]));

        }

    }

    $expectedtime = $workday * DAILY_TIME;
    $balance = getTimeStringFromSeconds(abs($sumofworkedtime - $expectedtime));
    $sign = ($sumofworkedtime >= $expectedtime) ? "+" : '-';

    loadTemplateView('monthly_report', ['report' => $report, 'sumofworkedtime' => getTimeStringFromSeconds($sumofworkedtime), 'balance' => "{$sign}{$balance}"]);