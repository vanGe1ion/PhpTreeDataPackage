<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 14:12
 */

namespace TreeData\traits;


use TreeData\interfaces\ITreeElem;
use TreeData\objects\{
    TreeElemType,
    Leaf,
    Branch,
    Node,
    Vacant
};

trait TIndex
{
    private $code;


    private function InitElem($code)
    {
        $this->code = $code;
    }

    public function GetCode()
    {
        return $this->code;
    }

    public function TreeElemType()
    {
        return end(explode("\\", __CLASS__));
    }

    public function ConvertTo(int $type) : ITreeElem
    {
        $currentType = $this->TreeElemType();
        if ($currentType !== TreeElemType::TypeName($type)){
            switch ($type){

                case TreeElemType::LEAF:
                    return new Leaf($this->code, (isset($this->leafData) ? $this->leafData : []));

                case TreeElemType::BRANCH:
                    return new Branch($this->code, (isset($this->childArray) ? $this->childArray : []));

                case TreeElemType::NODE:
                    return new Node(
                        $this->code,
                        (isset($this->leafData) ? $this->leafData : []),
                        (isset($this->childArray) ? $this->childArray : [])
                        );

                default:
                    return new Vacant($this->code);

            }
        }
        return $this;
    }

    public function JsonSerialize()
    {
        return get_object_vars($this);
    }

    public function toTableIndex($masterFields, $parent)
    {
        $result[$masterFields["code"]] = $this->code;
        $result[$masterFields["pCode"]] = $parent;
        return $result;
    }
}