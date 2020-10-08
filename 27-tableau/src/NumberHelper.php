<?php

namespace App;

class NumberHelper
{
    public static function price($number, $sigle = "€")
    {
        return number_format($number, 0, '', ' ') . ' ' . $sigle;
    }
}
