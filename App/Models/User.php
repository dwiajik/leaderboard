<?php

namespace App\Models;

class User
{
    private $id;
    private $email;
    private $username;
    private $password;
    private $fullname;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}