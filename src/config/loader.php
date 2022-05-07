<?php

    function loadModel($modelname) {

        require_once (MODEL_PATH . "/{$modelname}.php");

    }

    function loadView($viewname, $params = array()) {

        if (count($params) > 0) {

            foreach ($params as $key => $value) {

                if (strlen($key) > 0) {

                    ${$key} = $value;

                }

            }

        }
 
        require_once (VIEW_PATH . "/{$viewname}.php");

    }

    function loadTemplateView($viewname, $params = array()) {

        if (count($params) > 0) {

            foreach ($params as $key => $value) {

                if (strlen($key) > 0) {

                    ${$key} = $value;

                }

            }

        }

        $user = $_SESSION['user'];
        $workinghours = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));
        $workinginterval = $workinghours->getWorkedInterval()->format('%H:%I:%S');
        $exittime = $workinghours->getExitTime()->format('H:i:s');
        $activeclock = $workinghours->getActiveClock();
 
        require_once (TEMPLATE_PATH . "/header.php");
        require_once (TEMPLATE_PATH . "/left.php");
        require_once (VIEW_PATH . "/{$viewname}.php");
        require_once (TEMPLATE_PATH . "/footer.php");

    }

    function renderTitle($title, $subtitle, $icon) {

        require_once (TEMPLATE_PATH . '/title.php');

    }