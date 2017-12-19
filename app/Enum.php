<?php

namespace App;

abstract class Enum
{
    protected static $elements;

    public static function all()
    {
        return static::$elements;
    }
}
