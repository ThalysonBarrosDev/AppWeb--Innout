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

    function sumIntervals($intervalone, $intervaltwo) {

        $date = new DateTime('00:00:00');
        $date->add($intervalone);
        $date->add($intervaltwo);
        return (new DateTime('00:00:00'))->diff($date);

    }

    function subtractIntervals($intervalone, $intervaltwo) {

        $date = new DateTime('00:00:00');
        $date->add($intervalone);
        $date->sub($intervaltwo);
        return (new DateTime('00:00:00'))->diff($date);

    }

    function getDateFromInterval($interval) {

        return new DateTimeImmutable($interval->format('%H:%i:%s'));

    }

    function getDateFromString($str) {

        return DateTimeImmutable::createFromFormat('H:i:s', $str);

    }

    function getFirstDayOfMonth($date) {

        $time = getDateAsDateTime($date)->getTimestamp();
        return new DateTime(date('Y-m-1', $time));

    }

    function getLastDayOfMonth($date) {

        $time = getDateAsDateTime($date)->getTimestamp();
        return new DateTime(date('Y-m-t', $time));

    }

    function getSecondsFromDateInterval($interval) {

        $d1 = new DateTimeImmutable();
        $d2 = $d1->add($interval);
        return $d2->getTimestamp() - $d1->getTimestamp();

    }