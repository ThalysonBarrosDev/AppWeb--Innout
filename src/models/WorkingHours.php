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

        public function getActiveClock() {

            $nexttime = $this->getNextTime();

            if ($nexttime === 'time1' || $nexttime === 'time3') {

                return 'exittime';

            } elseif ($nexttime === 'time2' || $nexttime === 'time4') {

                return 'workedinterval';

            } else {

                return NULL;

            }

        }

        public function innout($time) {

            $timecolumn = $this->getNextTime();

            if (!$timecolumn) {

                throw new AppException("Você já bateu os 4 pontos diários!");

            }

            $this->$timecolumn = $time;
            $this->worked_time = getSecondsFromDateInterval($this->getWorkedInterval());

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

        function getLunchInterval() {

            [ , $t2, $t3, ] = $this->getTimes();

            $lunchinterval = new DateInterval('PT0S');

            if ($t2) { $lunchinterval = $t2->diff(new DateTime()); }
            if ($t3) { $lunchinterval = $t2->diff($t3); }

            return $lunchinterval;

        }

        function getExitTime() {

            [$t1, , , $t4] = $this->getTimes();

            $workday = DateInterval::createFromDateString('8 hours');

            if (!$t1) {

                return (new DateTime())->add($workday);

            } elseif ($t4) {

                return $t4;

            } else {

                $total = sumIntervals($workday, $this->getLunchInterval());

                return $t1->add($total);

            }

        }

        public static function getMonthlyReport($userid, $date) {

            $registries = [];

            $startdate = getFirstDayOfMonth($date)->format('Y-m-d');
            $enddate = getLastDayOfMonth($date)->format('Y-m-d');

            $result = static::getResultSetFromSelect(['user_id' => $userid, 'raw' => "work_date BETWEEN '{$startdate}' AND '{$enddate}'"]);

            if ($result) {

                while ($row = $result->fetch_assoc()) {

                    $registries[$row['work_date']] = new WorkingHours($row);

                }

            }

            return $registries;

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