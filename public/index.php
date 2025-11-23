<?php
// Front controller
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Session.php';
require_once __DIR__ . '/../app/core/Helpers.php';

Session::start();

spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../app/core/' . $class . '.php',
        __DIR__ . '/../app/controllers/' . $class . '.php',
        __DIR__ . '/../app/models/' . $class . '.php',
    ];
    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
});

$url = $_GET['url'] ?? '';
$url = trim($url, '/');
$segments = $url ? explode('/', $url) : [];

$router = new Router();
$router->route($segments);
