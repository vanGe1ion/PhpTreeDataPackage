<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 14:12
 */

namespace TreeData\traits;

trait TIndex
{
    private $code;


    private function InitElem($code)
    {
        $this->code = $code;
    }

    public function GetCode()
    {
        return $this->code;
    }

    //todo преобразовать в ToArray
//    public function DBSaveIndex(PgSql $pg, string $parent, string $query)
//    {
//        $queryParams = [
//            $this->code,
//            $parent
//        ];
//
//        $pg->ParamExecute($query, $queryParams);
//    }

    public function TreeElemType()
    {
        return end(explode("\\", __CLASS__));
    }
}