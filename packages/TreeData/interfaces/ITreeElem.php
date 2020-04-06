<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:44
 */

namespace TreeData\interfaces;


interface ITreeElem
{
    public function __clone();

    public function GetCode();
    public function TreeElemType();
    public function ConvertTo(int $type);
    public function toArray();
    public function toTable(&$table, $fields, $parent);
    public function JsonSerialize();
}