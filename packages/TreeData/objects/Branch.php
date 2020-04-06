<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:47
 */

namespace TreeData\objects;


use JsonSerializable;

use TreeData\interfaces\ITreeElem;
use TreeData\traits\{TIndex, TBranch};

class Branch implements ITreeElem, JsonSerializable
{
    use TIndex, TBranch;

    public function __construct(string $code, array $children = [])
    {
        $this->InitElem($code);
        $this->SetChildren($children);
    }

    //todo clone child
    public function __clone()
    {
        return new Branch($this->code, $this->childArray);
    }


    public function toArray()
    {
        $childArrays = [];
        foreach ($this->childArray as $code => $childElem)
            $childArrays[$code] = $childElem->toArray();
        return [
            "code" => $this->code,
            "childArray" => $childArrays
        ];
    }

    public function toTable(&$table, $fields, $parent)
    {
        $index = $this->toTableIndex($fields[0], $parent);
        foreach ($fields[1] as $field)
            $index[$field] = null;
        $table[$this->code] = $index;
        $this->toTableBranch($table, $fields);
    }

}