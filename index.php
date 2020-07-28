<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$a = __DIR__ . '/config/autoload.php';
include (__DIR__ . '/config/autoload.php');

$router = new Router();

$router->start();
