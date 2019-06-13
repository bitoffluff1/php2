<?php

namespace App\services;

class Autoload
{
    public function loadClass($className)
    {
        $name = explode("\\", $className);
        $file = $_SERVER["DOCUMENT_ROOT"] . "/../{$name[1]}/{$name[count($name)- 1]}.php";
        if (file_exists($file)) {
            include $file;
        }
    }
}
