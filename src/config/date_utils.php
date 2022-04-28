<?php

    function getDateAsDateTime($date) {

        return is_string($date) ? new DateTime($date) : $date;

    }

    function isWeekend($date) {

        $inputdate = getDateAsDateTime($date);
        return $inputdate->format('N') >= 6;

    }

    function isBefore($dateone, $datetwo) {

        $inputdateone = getDateAsDateTime($dateone);
        $inputdatetwo = getDateAsDateTime($datetwo);
        return $inputdateone <= $inputdatetwo;

    }

    function getNextDay($date) {

        $inputdate = getDateAsDateTime($date);
        $inputdate->modify('+1 day');
        return $inputdate;

    }