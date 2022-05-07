<?php

    session_start();
    requireValidSession();

    $currentdate = new DateTime();

    $user = $_SESSION['user'];
    $selecteduserid = $user->id;
    $users = null;

    if ($user->is_admin) {

        $users = User::get();
        $selecteduserid = $_POST['user'] ? $_POST['user'] : $user->id;
    }

    $selectedperiod = $_POST['period'] ? $_POST['period'] : $currentdate->format('Y-m');
    $periods = [];

    for ($yeardiff = 0; $yeardiff <= 1; $yeardiff++) {

        $year = date('Y') - $yeardiff;

        for ($month = 12; $month >= 1; $month--) {

            $date = new DateTime("{$year}-{$month}-1");
            $periods[$date->format('Y-m')] = strftime('%b de %Y', $date->getTimestamp());

        }

    }

    $registries = WorkingHours::getMonthlyReport($selecteduserid, $selectedperiod);

    $report = [];
    $workday = 0;
    $sumofworkedtime = 0;
    $lastday = getLastDayOfMonth($selectedperiod)->format('d');

    for ($day = 1; $day <= $lastday; $day++) {

        $date = $selectedperiod . '-' . sprintf('%02d', $day);
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

    loadTemplateView(
        'monthly_report',
        [
            'report' => $report, 
            'sumofworkedtime' => getTimeStringFromSeconds($sumofworkedtime), 
            'balance' => "{$sign}{$balance}",
            'selectedperiod' => $selectedperiod,
            'periods' => $periods,
            'users' => $users,
            'selecteduserid' => $selecteduserid
        ]
    );