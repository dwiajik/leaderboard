<?php

namespace App\Controllers;

class BaseController
{
    protected function view($viewName, $variables = [])
    {
        foreach (array_keys($variables) as $varName)
        {
            ${$varName} = $variables[$varName];
        }

        include __DIR__ . "/../Views/" . $viewName;
    }
}