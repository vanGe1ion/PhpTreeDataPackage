<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:44
 */

namespace classes\treedata;


use classes\PgSql;

interface ITreeData
{
    public function GetCode();
    public function SetPath(array $path);
    public function GetPath() : array;

    public function DBSave(PgSql $pg, string $query);
}