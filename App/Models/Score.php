<?php

namespace App\Models;

class Score
{
    private $id;
    private $instanceId;
    private $name;
    private $score;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}