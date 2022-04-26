<?php

    date_default_timezone_set('America/Sao_Paulo');
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

    // Pastas do Projeto
    define('MODEL_PATH', realpath(dirname(__FILE__) . '/../models'));
    define('VIEW_PATH', realpath(dirname(__FILE__) . '/../views'));
    define('CONTROLLER_PATH', realpath(dirname(__FILE__) . '/../controllers'));

    // Arquivos do Projeto
    require_once (realpath(dirname(__FILE__) . '/../database/Connection.php'));
    require_once (realpath(dirname(__FILE__) . '/loader.php'));
    require_once (realpath(MODEL_PATH . '/../models/Model.php'));
