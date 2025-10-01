<?php
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    date_default_timezone_set('America/Lima');

    define("APP_PATH", __DIR__ . "/../app/views/");
    define("CONTROLLER_PATH", __DIR__ . "/../app/controllers/");
    define("REPORT_PATH", __DIR__ . "/../reports/");

    $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'dashboard/inicio';

    $view = filter_var($url, FILTER_SANITIZE_URL);

    require_once __DIR__ . '/../routes/web.php';
    
    $viewFile = APP_PATH . $view . ".php";
    if (!file_exists($viewFile)) {
        $viewFile = APP_PATH . "dashboard/inicio.php";
    }

    require APP_PATH . "layout/layout.php";
?>
