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
 
        require_once (VIEW_PATH . "/{$viewname}.php");

    }