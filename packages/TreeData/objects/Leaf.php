<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:47
 */

namespace TreeData\objects;


use TreeData\interfaces\ITreeElem;
use TreeData\traits\{TIndex, TLeaf};

class Leaf implements ITreeElem
{
    use TIndex, TLeaf;

    public function __construct(string $code, array $data = [])
    {
        $this->InitElem($code);
        $this->SetData($data);
    }

    public function __clone()
    {
        return new Leaf($this->code, $this->leafData);
    }

    //todo преобразовать в ToArray
//    public function DBSave(PgSql $pg, string $parent, array $querySet)
//    {
//        $this->DBSaveIndex($pg, $parent, $querySet["insert"]);
//        $query = str_replace("{NodeTarget}", $this->code, $querySet["update"]);
//        $this->DBSaveNode($pg, $query);
//    }
}