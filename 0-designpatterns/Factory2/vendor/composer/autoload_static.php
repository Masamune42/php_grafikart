<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit80705d7ca37be57ea43bbc7537b3e4cb
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit80705d7ca37be57ea43bbc7537b3e4cb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit80705d7ca37be57ea43bbc7537b3e4cb::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
