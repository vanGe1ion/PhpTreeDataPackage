<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:47
 */

namespace TreeData\objects;


use TreeData\interfaces\ITreeElem;
use TreeData\traits\{TIndex, TBranch};

class Branch implements ITreeElem
{
    use TIndex, TBranch;

    public function __construct(string $code, array $children = [])
    {
        $this->InitElem($code);
        $this->SetChildren($children);
    }

    public function __clone()
    {
        return new Branch($this->code, $this->childArray);
    }

    //todo преобразовать в ToArray
//    public function DBSave(PgSql $pg, string $parent, array $querySet)
//    {
//        $this->DBSaveIndex($pg, $parent, $querySet["insert"]);
//        $this->DBSaveRoot($pg, $querySet);
//    }
}