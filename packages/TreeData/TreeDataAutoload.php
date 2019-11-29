<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 27.11.2019
 * Time: 15:09
 */


spl_autoload_register(function ($class){
    $dir = str_replace("\\", "/", __DIR__);
    $dir = str_replace("TreeData", "", $dir);
    $fullName = str_replace("\\", "/", $class).".php";
    $classPath = $dir . $fullName;
    require_once $classPath;
});