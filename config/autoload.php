<?php

function myAutoload($class)
{
    $path = __DIR__ . '/../' . $class . '.php';
    $newPath = strtr($path, '\\', '/');
    include $newPath;
}

spl_autoload_register('myAutoload');
