<?php
    define('APP_ROOT', __DIR__);
    require_once(__DIR__ . '/../vendor/autoload.php');

    use Sebastian\Kernel;

    $app = new Kernel("local_dev");
    $response = $app->run();
    $response->send();
    
    $app->shutdown($response);