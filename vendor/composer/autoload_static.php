<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfcaf487f29fe20130aa0837e60d314a7
{
    public static $files = array (
        '4de88b30864e6c7e7890588f00ae3503' => __DIR__ . '/../..' . '/inc/asset-settings.php',
        '3c0dda5eb8fe5459a6618c02443a0406' => __DIR__ . '/../..' . '/inc/setup.php',
        '622a87f121282c24fba97dc3f67d3c92' => __DIR__ . '/../..' . '/inc/utils.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
        'A' => 
        array (
            'Ampersarnie\\WP\\Theme\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
        'Ampersarnie\\WP\\Theme\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Ampersarnie\\WP\\Theme\\Clearance' => __DIR__ . '/../..' . '/inc/class-clearance.php',
        'Ampersarnie\\WP\\Theme\\Loader' => __DIR__ . '/../..' . '/inc/class-loader.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfcaf487f29fe20130aa0837e60d314a7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfcaf487f29fe20130aa0837e60d314a7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfcaf487f29fe20130aa0837e60d314a7::$classMap;

        }, null, ClassLoader::class);
    }
}
