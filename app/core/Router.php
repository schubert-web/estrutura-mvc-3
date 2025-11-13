<?php

namespace App\Core;

use App\Controllers\HomeController;
use App\Controllers\Errors\HttpErrorController;

class Router{
    public function dispatch($url)
    {
        $url = trim($url, '/');
        $parts = $url ? explode('/', $url) : [];

        //var_dump($parts);

        $controllerName = $parts[0] ?? 'Home';
        $controllerName = 'App\Controllers\\' . ucfirst($controllerName) . 'Controller';
;
        $actionName = $parts[1] ?? 'index';
        

        if(!class_exists($controllerName)){
            $controller = new HttpErrorController();
            $controller->notFound();
            return;
        }

        // instanciando pelo nome da variável
        $controller = new $controllerName;


        if(!method_exists($controller, $actionName)){
            $controller = new HttpErrorController();
            $controller->notFound();
            return;
        }

        $params = array_slice($parts, 2);
        dd($actionName,$controllerName, $parts, $url);

        call_user_func_array([$controller, $actionName], $params);
    }
}