<?php
    define('APP_ROOT', __DIR__);
    require_once(__DIR__ . '/../vendor/autoload.php');

    $kernel = new StardewTP\AppKernel("dev");
    $response = $kernel->run();
    $response->send();
    
    $kernel->shutdown($response);