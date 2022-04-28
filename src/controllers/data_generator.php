<?php

    loadModel('WorkingHours');

    Database::executeSQL('DELETE FROM working_hours');
    Database::executeSQL('DELETE FROM users WHERE id > 5');

    function getDatTemplateByOdds($regular_rate, $extra_rate, $lazy_rate) {

        $regular_day_template = [
            'time1' => '08:00:00',
            'time2' => '12:00:00',
            'time3' => '13:00:00',
            'time4' => '17:00:00',
            'worked_time' => DAILY_TIME
        ];
    
        $extrahour_day_template = [
            'time1' => '08:00:00',
            'time2' => '12:00:00',
            'time3' => '13:00:00',
            'time4' => '17:00:00',
            'worked_time' => DAILY_TIME + 3600
        ];
    
        $lazy_day_template = [
            'time1' => '08:30:00',
            'time2' => '12:00:00',
            'time3' => '13:00:00',
            'time4' => '17:00:00',
            'worked_time' => DAILY_TIME - 1800
        ];

        $value = rand(0, 100);

        if ($value <= $regular_rate) {

            return $regular_day_template;

        } elseif ($value <= $regular_rate + $extra_rate) {

            return $extrahour_day_template;

        } else {

            return $lazy_day_template;

        }

    }

    function populateWorkingHours($user_id, $initial_date, $regular_rate, $extra_rate, $lazy_rate) {

        $current_date = $initial_date;
        $yesterday = new DateTime();
        $yesterday->modify('-1 day');
        $colums = ['user_id' => $user_id, 'work_date' => $current_date];

        while (isBefore($current_date, $yesterday)) {

            if (!isWeekend($current_date)) {

                $template = getDatTemplateByOdds($regular_rate, $extra_rate, $lazy_rate);
                $colums = array_merge($colums, $template);
                $working_hours = new WorkingHours($colums);
                $working_hours->insert();

            }

            $current_date = getNextDay($current_date)->format('Y-m-d');
            $colums['work_date'] = $current_date;

        }

    }

    //$lastmonth = strtotime('first day of last month');

    populateWorkingHours(1, date('Y-m-1'), 70, 20, 10);
    populateWorkingHours(3, date('Y-m-1'), 20, 75, 5);
    populateWorkingHours(4, date('Y-m-1'), 20, 10, 70);

    echo 'Dados gerado com sucesso! :)';