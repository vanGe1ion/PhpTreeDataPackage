<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 22.11.2019
 * Time: 11:09
 */

use exceptions\FileNotFoundException;

spl_autoload_register(function ($class){
    $classPath = str_replace("\\", "/", $class).".php";
    try {
        FileConnector($classPath);
    }
    catch (FileNotFoundException $e){
        echo ($e);
        var_dump($e->getTrace());
        die();
    }
});


function FileConnector($path){
    if(file_exists($path))
        require_once $path;
    else
        throw new FileNotFoundException("Файл {$path} не найден");
}
