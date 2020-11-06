<?php

namespace App;

class CarFactory{
    public static function getCar(string $type): Car
    {
        $type = ucfirst($type);
        $class_name = "App\Car$type"; // getCar(4x4) => Car4x4
        return new $class_name();
    }
}