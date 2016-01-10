<?php

namespace App\Models;

class Instance
{
    private $id;
    private $password;
    private $userId;
    private $name;
    private $description;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}