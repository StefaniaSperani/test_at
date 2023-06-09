<?php

class Loader
{
    public static function load($dir, $className)
    {
        $path = "$dir/{$className}.php";
        if (file_exists($path) && !is_dir($path)) {
            require_once $path;
            return true;
        }
        return false;
    }
}

function autoload($className)
{
    $classFileName = str_replace("\\", "/", $className);
    Loader::load(__ROOT_DIR__, $classFileName);
}

spl_autoload_register("autoload");