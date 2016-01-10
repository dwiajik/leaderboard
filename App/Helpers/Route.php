<?php

namespace App\Helpers;

class Route
{
    private $routePath;
    private $httpRequest;
    private $controller;
    private $controllerMethod;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}