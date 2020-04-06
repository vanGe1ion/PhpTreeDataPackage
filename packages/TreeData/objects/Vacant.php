<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 14.01.2020
 * Time: 14:12
 */

namespace TreeData\objects;

use JsonSerializable;

use TreeData\interfaces\ITreeElem;
use TreeData\traits\TIndex;

class Vacant implements ITreeElem, JsonSerializable
{
    use TIndex;

    public function __construct(string $code)
    {
        $this->InitElem($code);
    }

    public function __clone()
    {
        return new Vacant($this->code);
    }

    public function toArray()
    {
        return [
            "code" => $this->code
        ];
    }

    public function toTable(&$table, $fields, $parent)
    {
        $index = $this->toTableIndex($fields[0], $parent);
        foreach ($fields[1] as $field)
            $index[$field] = null;
        $table[$this->code] = $index;
    }
}