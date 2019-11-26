<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 14:12
 */

namespace classes\treedata;


trait TIndex
{
    private $code;
    private $path;

    private function InitIndex($code, $path){
        $this->code = $code;
        $this->path = $path;
    }

    public function GetCode(){
        return $this->code;
    }

    public function SetPath(array $path){
        $this->path = $path;
    }

    public function GetPath(){
        return $this->path;
    }
}