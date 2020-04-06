<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:43
 */

namespace TreeData\traits;


use TreeData\exceptions\ChildNotFoundException;
use TreeData\interfaces\ITreeElem;

trait TBranch
{
    private $childArray;


    public function SetChildren(array $childArray)
    {
        $this->childArray = array();
        if(count($childArray) > 0)
            foreach ($childArray as $child)
                $this->AddChild($child);
    }

    public function GetChildren()
    {
        return $this->childArray;
    }

    //todo duplicate exc
    public function AddChild(ITreeElem $child)
    {
        $newChild = clone $child;
        $this->childArray[$newChild->GetCode()] = $newChild;
    }

    public function DeleteChild($index)
    {
        unset($this->childArray[$index]);
    }

    public function GetChild($index) : ITreeElem {
        if(isset($this->childArray[$index]))
            return $this->childArray[$index];
        else
            throw new ChildNotFoundException(
                explode("::", __METHOD__ )[1] . "(): 
                Child elem({$index}) not found in elem({$this->code})"
            );
    }

    public function toTableBranch(&$table, $fields)
    {
        foreach ($this->childArray as $code =>$child)
            $result[$code] = $child->toTable($table, $fields, $this->code);
    }
}