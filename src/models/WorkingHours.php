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

        public function getNextTime() {

            if (!$this->time1) return 'time1';
            if (!$this->time2) return 'time2';
            if (!$this->time3) return 'time3';
            if (!$this->time4) return 'time4';

            return NULL;

        }

        public function innout($time) {

            $timecolumn = $this->getNextTime();

            if (!$timecolumn) {

                throw new AppException("Você já bateu os 4 pontos diários!");

            }

            $this->$timecolumn = $time;

            if ($this->id) {

                $this->update();

            } else {

                $this->insert();

            }

        }

    }