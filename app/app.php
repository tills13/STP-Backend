<?php
    define('APP_ROOT', __DIR__);
    require_once(__DIR__ . '/../vendor/autoload.php');

    $kernel = new SVX\AppKernel("dev");
    $response = $kernel->run();
    if ($response) $response->send();
    
    $kernel->shutdown($response);