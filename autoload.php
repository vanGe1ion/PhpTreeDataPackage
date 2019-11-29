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
        if(file_exists($classPath))
            require_once $classPath;
        else
            throw new FileNotFoundException("Файл {$classPath} не найден");
    }
    catch (FileNotFoundException $e){
        //Если файл не найден, проверяем другие автолоуды

//        echo ($e);
//        var_dump($e->getTrace());
//        die();
    }
});