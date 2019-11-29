<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:48
 */

namespace TreeData\objects;


use TreeData\interfaces\ITreeElem;
use TreeData\traits\{TIndex, TNode, TRoot};

use classes\PgSql;

class Tree implements ITreeElem
{
    use TIndex, TNode, TRoot;

    public function __construct(string $code, array $data = [], array $children = [])
    {
        $this->InitIndex($code);
        $this->InitNode($data);
        $this->InitRoot($children);
    }

    public function __clone(){
        return new Tree($this->code, $this->data, $this->childArray);
    }

    public function DBSave(PgSql $pg, string $parent, array $querySet)
    {
        $this->DBSaveIndex($pg, $parent, $querySet["insert"]);
        $query = str_replace("{NodeTarget}", $this->code, $querySet["update"]);
        $this->DBSaveNode($pg, $query);
        $this->DBSaveRoot($pg, $querySet);
    }
}