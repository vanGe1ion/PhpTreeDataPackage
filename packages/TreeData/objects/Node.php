<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:48
 */

namespace TreeData\objects;


use JsonSerializable;

use TreeData\interfaces\ITreeElem;
use TreeData\traits\{TIndex, TLeaf, TBranch};

class Node implements ITreeElem, JsonSerializable
{
    use TIndex, TLeaf, TBranch;

    public function __construct(string $code, array $data = [], array $children = [])
    {
        $this->InitElem($code);
        $this->SetData($data);
        $this->SetChildren($children);
    }

    //todo clone child
    public function __clone(){
        return new Node($this->code, $this->leafData, $this->childArray);
    }

    public function toArray()
    {
        $childArrays = [];
        foreach ($this->childArray as $code => $childElem)
            $childArrays[$code] = $childElem->toArray();
        return [
            "code" => $this->code,
            "leafData" => $this->leafData,
            "childArray" => $childArrays
        ];
    }

    public function toTable(&$table, $fields, $parent)
    {
        $index = $this->toTableIndex($fields[0], $parent);
        $data = $this->toTableLeaf($fields[1]);
        $table[$this->code] = array_merge($index, $data);
        $this->toTableBranch($table, $fields);
    }

}