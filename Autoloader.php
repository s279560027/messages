<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.03.2017
 * Time: 17:38
 */

namespace App;

use App\Application;

class Autoloader
{
    private static $basePath = '';

    public static function register($basePath = '')
    {
        self::$basePath = $basePath;
        return spl_autoload_register(array(__CLASS__, 'load'));
    }

    public static function load($class)
    {
        $filename = self::$basePath . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
        if ((file_exists($filename) === false) || (is_readable($filename) === false)) {
            return false;
        }
        require_once $filename;
    }
}

Autoloader::Register('src');