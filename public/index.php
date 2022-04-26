<?php

    require_once (dirname(__FILE__, 2) . '/src/config/config.php');
    
    $uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    if ($uri == '/Projeto_Innout/public/' || $uri == 'Projeto_Innout/public' || $uri == 'Projeto_Innout/public/index.php') {

        $uri = '/login.php';

    }

    require_once (CONTROLLER_PATH . "/{$uri}");