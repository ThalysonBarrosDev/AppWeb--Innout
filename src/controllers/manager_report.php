<?php

    session_start();
    requireValidSession(true);

    $activeuserscount = User::getActiveUsersCount();
    $absentusers = WorkingHours::getAbsentUsers();

    $yearandmonth = (new DateTime())->format('Y-m');
    $seconds = WorkingHours::getWorkedTimeInMonth($yearandmonth);
    $hoursinmonth = explode(':', getTimeStringFromSeconds($seconds))[0];

    loadTemplateView('manager_report', [
        'activeuserscount' => $activeuserscount,
        'absentusers' => $absentusers,
        'hoursinmonth' => $hoursinmonth,
    ]);