<?php

    session_start();
    requireValidSession();

    $user = $_SESSION['user'];
    $records = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));

    try {

        $currenttime = strftime('%H:%M:%S', time());
        $records->innout($currenttime);

        addSuccessMsg('Ponto batido com sucesso!');

    } catch (AppException $e) {

        addErrorMsg($e->getMessage());

    }

    header('Location: day_records.php');