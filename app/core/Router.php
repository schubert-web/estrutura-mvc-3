<?php

require_once("../app/controllers/HttpErrorController.php");
require_once("../app/controllers/HomeController.php");
require_once("../app/controllers/errors/NoticiasController.php");


class Router{
    public function dispatch($url)
    {
        $url = trim($url, '/');
        $parts = $url ? explode('/', $url) : [];

        $controllerName = $parts[0] ?? 'Home';
        $controllerName = ucfirst($controllerName) . 'Controller';

        $actionName = $parts[1] ?? 'index';


        if(!class_exists($controllerName)){
            $controller = new HttpErrorController();
            $controller->notFound();
            return;
        }

        // instanciando pelo nome da variável
        $controller = new $controllerName();


        if(!method_exists($controller, $actionName)){
            $controller = new HttpErrorController();
            $controller->notFound();
            return;
        }

        $params = array_slice($parts, 2);

        call_user_func_array([$controller, $actionName], $params);
    }
}