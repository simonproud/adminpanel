<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitda59300ca8876dd21050b9a149965772
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Permissions\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Permissions\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Modules\\Permissions\\Database\\Seeders\\PermissionsDatabaseSeeder' => __DIR__ . '/../..' . '/Database/Seeders/PermissionsDatabaseSeeder.php',
        'Modules\\Permissions\\Http\\Controllers\\PermissionController' => __DIR__ . '/../..' . '/Http/Controllers/PermissionController.php',
        'Modules\\Permissions\\Http\\Controllers\\PermissionsController' => __DIR__ . '/../..' . '/Http/Controllers/PermissionsController.php',
        'Modules\\Permissions\\Providers\\PermissionsServiceProvider' => __DIR__ . '/../..' . '/Providers/PermissionsServiceProvider.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitda59300ca8876dd21050b9a149965772::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitda59300ca8876dd21050b9a149965772::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitda59300ca8876dd21050b9a149965772::$classMap;

        }, null, ClassLoader::class);
    }
}