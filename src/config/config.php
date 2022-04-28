<?php

    error_reporting(E_ERROR);

    date_default_timezone_set('America/Sao_Paulo');
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

    // Constantes Gerais
    define('DAILY_TIME', 60 * 60 * 8);

    // Pastas do Projeto
    define('MODEL_PATH', realpath(dirname(__FILE__) . '/../models'));
    define('VIEW_PATH', realpath(dirname(__FILE__) . '/../views'));
    define('TEMPLATE_PATH', realpath(dirname(__FILE__) . '/../views/template'));
    define('CONTROLLER_PATH', realpath(dirname(__FILE__) . '/../controllers'));
    define('EXCEPTION_PATH', realpath(dirname(__FILE__) . '/../exceptions'));

    // Arquivos do Projeto
    require_once (realpath(dirname(__FILE__) . '/../database/Connection.php'));
    require_once (realpath(dirname(__FILE__) . '/loader.php'));
    require_once (realpath(dirname(__FILE__) . '/session.php'));
    require_once (realpath(MODEL_PATH . '/../models/Model.php'));
    require_once (realpath(MODEL_PATH . '/../models/User.php'));
    require_once (realpath(EXCEPTION_PATH . '/../exceptions/AppException.php'));
    require_once (realpath(EXCEPTION_PATH . '/../exceptions/ValidationException.php'));