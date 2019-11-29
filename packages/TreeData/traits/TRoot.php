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

use classes\PgSql;

trait TRoot
{
    private $childArray;

    private function InitRoot(array $children)
    {
        $this->SetChildren($children);
    }

    public function SetChildren(array $children){
        $this->childArray = array();
        if(count($children) > 0)
            foreach ($children as $child)
                $this->AddChild($child);
    }

    public function GetChildren(){
        return $this->childArray;
    }

    public function AddChild(ITreeElem $child){
        $newChild = clone $child;
        $this->childArray[$newChild->GetCode()] = $newChild;
    }

    public function RemoveChild($index){
        unset($this->childArray[$index]);
    }

    public function GetChild($index) : ITreeElem {
        if(isset($this->childArray[$index]))
            return $this->childArray[$index];
        else
            throw new ChildNotFoundException(
                explode("::", __METHOD__ )[1] . "(): 
                Child({$index}) not found in elem({$this->code})"
            );
    }

    public function DBSaveRoot(PgSql $pg, array $querySet)
    {
        foreach ($this->childArray as $child)
            $child->DBSave($pg, $this->code, $querySet);
    }
}