<?php

namespace App\Helpers;

class RandomGenerator
{
    public static function alphanumeric($length = 6)
    {
        $md5hash = "";
        for ($i = 0; $i < 7; $i++)
        {
            $md5hash .= md5(rand());
        }
        $base64encoded = base64_encode($md5hash);
        preg_replace("/[^A-Za-z0-9 ]/", '', $base64encoded);
        $randomAlphanumeric = substr($base64encoded, 0, $length);
        return $randomAlphanumeric;
    }
}