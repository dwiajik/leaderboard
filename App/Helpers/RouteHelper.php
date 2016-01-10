<?php

namespace App\Helpers;

use App\Controllers\InstanceController;
use App\Controllers\ScoreController;

class RouteHelper
{
    public static function route()
    {
        $routeList = RouteHelper::readRouteFile();
        $base_url = RouteHelper::getCurrentUri();

        $requestMethod = $_SERVER['REQUEST_METHOD'];

        $controllerName =  "App" . '\\' . "Controllers" . '\\' . $routeList[$requestMethod . ":" .$base_url]->controller;
        $methodName = $routeList[$requestMethod . ":" .$base_url]->controllerMethod;

        $methodName = trim($methodName);

        if (class_exists($controllerName))
        {
            $controller = new $controllerName();
            $controller->$methodName();
        }
        else
        {
            $explodedUri = explode('/', $base_url);

            if ($explodedUri[1] == "instance" && strlen($explodedUri[2]) == 25)
            {
                $controller = new InstanceController();
                $controller->show($explodedUri[2]);
            }
            else if ($explodedUri[1] == "score" && strlen($explodedUri[2]) == 25)
            {
                $controller = new ScoreController();
                $controller->index($explodedUri[2]);
            }
            else
            {
                echo "404 Not Found";
            }
        }
    }

    private static function getCurrentUri()
    {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
        $uri = '/' . trim($uri, '/');
        return $uri;
    }

    private static function readRouteFile()
    {
        $routeFile = fopen(realpath("./../App/routes"), "r") or die("Unable to open file!");
        $routeText = fread($routeFile, filesize(realpath("./../App/routes")));
        $routeArray = explode("\n", $routeText);
        $routes = array();
        foreach ($routeArray as $row)
        {
            $temp = explode(" ", $row);

            $route = new Route();
            $route->httpRequest = $temp[0];
            $route->routePath = $temp[1];
            $route->controller = explode("@", $temp[2])[0];
            $route->controllerMethod = explode("@", $temp[2])[1];

            $routes[$temp[0] . ":" . $temp[1]] = $route;
        }
        fclose($routeFile);

        return $routes;
    }

    public static function go($url)
    {
        echo "/". $url;
    }
}