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
use TreeData\traits\{TIndex, TNode};

class Node implements ITreeElem
{
    use TIndex, TNode;

    public function __construct(string $code, array $data = [])
    {
        $this->InitIndex($code);
        $this->InitNode($data);
    }

    public function __clone()
    {
        return new Node($this->code, $this->data);
    }

    public function DBSave(PgSql $pg, string $parent, array $querySet)
    {
        $this->DBSaveIndex($pg, $parent, $querySet["insert"]);
        $query = str_replace("{NodeTarget}", $this->code, $querySet["update"]);
        $this->DBSaveNode($pg, $query);
    }
}