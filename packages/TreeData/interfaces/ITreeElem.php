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
    public function GetCode();
    public function TreeElemType();
    //    public function DBSave(PgSql $pg, string $parent, array $querySet);

}