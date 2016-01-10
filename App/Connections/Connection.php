<?php

namespace App\Connections;

use App\Helpers\ConfigHelper;
use PDO;
use PDOException;

class Connection
{
    private static $cont = null;

    public function __construct()
    {
        exit('Init function is not allowed');
    }

    public static function connect()
    {
        $host = ConfigHelper::getConfig("DB_HOST") or "localhost";
        $database = ConfigHelper::getConfig("DB_NAME") or "suket";
        $username = ConfigHelper::getConfig("DB_USERNAME") or "root";
        $password = ConfigHelper::getConfig("DB_PASSWORD") or "";

        // One connection through whole application
        if (null == self::$cont) {
            try {
                self::$cont = new PDO("mysql:host=" . $host . ";" . "dbname=" . $database,
                    $username,
                    $password);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect()
    {
        self::$cont = null;
    }
}
