<?php


class Router
{
    public function start()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $routes = include (__DIR__ . '/config/route.php');
        foreach ($routes as $route => $controllerAction) {
            if($uri == $route){
                $controllerAction = explode('/', $controllerAction);
                $controller = 'Controller\\' . ucfirst($controllerAction[0]) . 'Controller';
                $action = $controllerAction[1];
                $controllerObject = new $controller;
                call_user_func(array($controllerObject, $action));
                break;
            }
        }
    }
}