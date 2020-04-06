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
use TreeData\traits\{TIndex, TLeaf};

class Leaf implements ITreeElem, JsonSerializable
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

    public function toArray()
    {
        return [
            "code" => $this->code,
            "leafData" => $this->leafData
        ];
    }

    public function toTable(&$table, $fields, $parent)
    {
        $index = $this->toTableIndex($fields[0], $parent);
        $data = $this->toTableLeaf($fields[1]);
        $table[$this->code] = array_merge($index, $data);
    }
}