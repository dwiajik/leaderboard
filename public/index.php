<?php

error_reporting(E_ERROR | E_PARSE);

function __autoload($class_name) {
    $class_name = str_replace('\\', '/', $class_name);
    include '../' . $class_name . '.php';
}

use App\Helpers\RouteHelper;

RouteHelper::route();