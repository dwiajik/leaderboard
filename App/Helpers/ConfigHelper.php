<?php

namespace App\Helpers;

class ConfigHelper
{
    public static function getConfig ($key)
    {
        try
        {
            $configFile = fopen(realpath("./../config"), "r") or die("Unable to open file!");
            $configText = fread($configFile, filesize(realpath("./../config")));
        }
        catch (\Exception $e)
        {
            $configFile = fopen(realpath("./config"), "r") or die("Unable to open file!");
            $configText = fread($configFile, filesize(realpath("./config")));
        }
        $configArray = explode("\n", $configText);
        $configs = array();
        foreach ($configArray as $element)
        {
            $temp = explode("=", $element);
            $configs[trim($temp[0])] = trim($temp[1]);
        }
        fclose($configFile);

        return $configs[$key];
    }
}