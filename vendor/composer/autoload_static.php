<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2f11da915848043b86148977ada39482
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'core\\' => 5,
            'components\\' => 11,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'components\\' => 
        array (
            0 => __DIR__ . '/../..' . '/components',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2f11da915848043b86148977ada39482::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2f11da915848043b86148977ada39482::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}