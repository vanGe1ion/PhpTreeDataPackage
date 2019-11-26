<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:43
 */

namespace classes\treedata;


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

    public function AddChild(ITreeData $child){
        $newPath = $this->GetPath();
        array_push($newPath, $this->GetCode());
        $newChild = clone $child;
        $newChild->SetPath($newPath);
        $this->childArray[$newChild->GetCode()] = $newChild;
    }

    public function RemoveChild($index){
        unset($this->childArray[$index]);
    }

    public function GetChild($index) : ITreeData {
        if(isset($this->childArray[$index]))
            return $this->childArray[$index];
        else
            return null;
    }

    public function DBSave(PgSql $pg, string $query)
    {
        foreach ($this->childArray as $child)
            $child->DBSave($pg, $query);
    }
}