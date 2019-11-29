<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:47
 */

namespace TreeData\objects;


use classes\PgSql;
use TreeData\interfaces\ITreeElem;
use TreeData\traits\{TIndex, TRoot};


class Root implements ITreeElem
{
    use TIndex, TRoot;

    public function __construct(string $code, array $children = [])
    {
        $this->InitIndex($code);
        $this->InitRoot($children);
    }

    public function __clone()
    {
        return new Root($this->code, $this->childArray);
    }

    public function DBSave(PgSql $pg, string $parent, array $querySet)
    {
        $this->DBSaveIndex($pg, $parent, $querySet["insert"]);
        $this->DBSaveRoot($pg, $querySet);
    }
}