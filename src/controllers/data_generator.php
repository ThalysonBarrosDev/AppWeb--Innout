<?php

    function getDatTemplateByOdds($regular_rate, $extra_rate, $lazy_rate) {

        $regular_day_template = [
            'time1' => '08:00:00',
            'time1' => '12:00:00',
            'time1' => '13:00:00',
            'time1' => '17:00:00',
            'worked_time' => DAILY_TIME
        ];
    
        $extrahour_day_template = [
            'time1' => '08:00:00',
            'time1' => '12:00:00',
            'time1' => '13:00:00',
            'time1' => '17:00:00',
            'worked_time' => DAILY_TIME + 3600
        ];
    
        $lazy_day_template = [
            'time1' => '08:30:00',
            'time1' => '12:00:00',
            'time1' => '13:00:00',
            'time1' => '17:00:00',
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