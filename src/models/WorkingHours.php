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

        function getWorkedInterval() {

            [$t1, $t2, $t3, $t4] = $this->getTimes();

            $part1 = new DateInterval('PT0S');
            $part2 = new DateInterval('PT0S');

            if ($t1) { $part1 = $t1->diff(new DateTime()); }
            if ($t2) { $part1 = $t1->diff($t2); }
            if ($t3) { $part2 = $t3->diff(new DateTime()); }
            if ($t4) { $part2 = $t3->diff($t4); }

            return sumIntervals($part1, $part2);

        }

        private function getTimes() {

            $times = [];

            $this->time1 ? array_push($times, getDateFromString($this->time1)) : array_push($times, NULL);
            $this->time2 ? array_push($times, getDateFromString($this->time2)) : array_push($times, NULL);
            $this->time3 ? array_push($times, getDateFromString($this->time3)) : array_push($times, NULL);
            $this->time4 ? array_push($times, getDateFromString($this->time4)) : array_push($times, NULL);

            return $times;

        }

    }