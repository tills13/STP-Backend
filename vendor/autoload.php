<?php
    $map = [
        'SVX' => 'app'
    ];

    $autoLoader = function($className) use ($map) {
        $className = explode('\\', $className);
        $rootNamespace = $className[0];

        $className = implode('/', $className);

        if (isset($map[$rootNamespace])) {
            $path = __DIR__ . "/../{$map[$rootNamespace]}/{$className}.php";
        } else {
            $path = __DIR__ . "/{$className}.php";
        }

        include_once($path);
        //require_once($path);
    };

    spl_autoload_register($autoLoader);