<?php
// load config
require_once(__DIR__ . "/src/utils/db.php");
require_once(__DIR__ . '/src/utils/config.php');

// load views
$req = explode("?", $_SERVER["REQUEST_URI"])[0];

$route = trim($req, '/');
$filePath = $VIEW_DIR . ($route === '' ? 'home' : $route) . '.php';


if (strpos($route, 'action/') === 0) {
    header('Content-Type: application/json; charset=utf-8');
    require_once($filePath);
} elseif (file_exists($filePath)) {
    session_start();
    require_once($FRAGMENT_DIR . 'global_style.php');
    require_once($filePath);
} else {
    http_response_code(404);
    require_once($FRAGMENT_DIR . 'global_style.php');
    require_once($VIEW_DIR . '404.php');
}