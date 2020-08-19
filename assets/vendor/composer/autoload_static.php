<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0760073f1af742cf134fd9dfc2ca64c9
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Picqer\\Barcode\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Picqer\\Barcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/picqer/php-barcode-generator/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0760073f1af742cf134fd9dfc2ca64c9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0760073f1af742cf134fd9dfc2ca64c9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
