<?php

    class WorkingHours extends Model {

        protected static $tablename = 'working_hours';
        protected static $columns = ['id', 'user_id', 'work_date', 'time1', 'time2', 'time3', 'time4', 'worked_time'];

        public static function loadFromUserAndDate($userid, $workdate) {

            $registry = self::getOne(['user_id' => $userid, 'work_date' => $workdate]);

            if (!$registry) {

                $registry = new WorkingHours([
                    'user_id' => $userid, 
                    'work_date' => $workdate,
                    'worked_time' => 0
                ]);

            }

            return $registry;

        }

    }