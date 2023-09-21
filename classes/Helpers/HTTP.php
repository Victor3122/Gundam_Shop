<?php

namespace Helpers;

class HTTP
{
    private static $root = 'http://localhost/gundam_shop';

    public static function redirect(String $path, String $query = '')
    {
        $url = static::$root . $path;
        if ($query) $url .= "?$query";

        header("location: $url");
        exit();
    }
}
