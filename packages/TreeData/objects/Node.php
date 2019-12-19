<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:48
 */

namespace TreeData\objects;


use TreeData\interfaces\ITreeElem;
use TreeData\traits\{TIndex, TLeaf, TBranch};

class Node implements ITreeElem
{
    use TIndex, TLeaf, TBranch;

    public function __construct(string $code, array $data = [], array $children = [])
    {
        $this->InitElem($code);
        $this->SetData($data);
        $this->SetChildren($children);
    }

    public function __clone(){
        return new Node($this->code, $this->leafData, $this->childArray);
    }

    //todo преобразовать в ToArray
//    public function DBSave(PgSql $pg, string $parent, array $querySet)
//    {
//        $this->DBSaveIndex($pg, $parent, $querySet["insert"]);
//        $query = str_replace("{NodeTarget}", $this->code, $querySet["update"]);
//        $this->DBSaveNode($pg, $query);
//        $this->DBSaveRoot($pg, $querySet);
//    }
}