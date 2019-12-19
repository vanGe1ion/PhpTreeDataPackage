<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 19.12.2019
 * Time: 12:11
 */

namespace TreeData\objects;


use TreeData\exceptions\{
    DataNotFoundException,
    GetDataException,
    NonBranchException,
    NonLeafException
};
use TreeData\interfaces\ITreeElem;

class Operator
{
    public $treeElem;

    public function __construct(ITreeElem $elem)
    {
        $this->treeElem = $elem;
    }

    public function InsertElemFork(ITreeElem $elem)
    {
        $elemType = $this->treeElem->TreeElemType();
        if ($elemType === "Leaf")
            throw new NonBranchException(
                explode("::", __METHOD__ )[1] . "(): 
                Operator can't insert elem({$elem->GetCode()}) to '{$elemType}' elem({$this->treeElem->GetCode()})"
            );
        else
            $this->treeElem->AddChild($elem);
    }

    public function DefineElemForkSet(array $set)
    {
        $elemType = $this->treeElem->TreeElemType();
        if ($elemType === "Leaf")
            throw new NonBranchException(
                explode("::", __METHOD__ )[1] . "(): 
                Operator can't define elem set of '{$elemType}' elem({$this->treeElem->GetCode()})"
            );
        else
            $this->treeElem->SetChildren($set);
    }

    public function RemoveElemFork(string $index)
    {
        $elemType = $this->treeElem->TreeElemType();
        if ($elemType === "Leaf")
            throw new NonBranchException(
                explode("::", __METHOD__ )[1] . "(): 
                Operator can't remove elem({$index}) of '{$elemType}' elem({$this->treeElem->GetCode()})"
            );
        else
            $this->treeElem->DeleteChild($index);
    }

    public function GetElemForks(): array
    {
        $elemType = $this->treeElem->TreeElemType();
        if ($elemType === "Leaf")
            throw new NonBranchException(
                explode("::", __METHOD__ )[1] . "(): 
                Operator can't return forks of '{$elemType}' elem({$this->treeElem->GetCode()})"
            );
        else
            return array_keys($this->treeElem->GetChildren());
    }

    public function InsertElemData($name, $value)
    {
        $elemType = $this->treeElem->TreeElemType();
        if ($elemType === "Branch")
            throw new NonLeafException(
                explode("::", __METHOD__ )[1] . "(): 
                Operator can't insert data to '{$elemType}' elem({$this->treeElem->GetCode()})"
            );
        else
            $this->treeElem->$name = $value;
    }

    public function DefineElemDataSet(array $data)
    {
        $elemType = $this->treeElem->TreeElemType();
        if ($elemType === "Branch")
            throw new NonLeafException(
                explode("::", __METHOD__ )[1] . "(): 
                Operator can't define data set of '{$elemType}' elem({$this->treeElem->GetCode()})"
            );
        else
            $this->treeElem->SetData($data);
    }

    public function RemoveElemData($name)
    {
        $elemType = $this->treeElem->TreeElemType();
        if ($elemType === "Branch")
            throw new NonLeafException(
                explode("::", __METHOD__ )[1] . "(): 
                Operator can't remove data of '{$elemType}' elem({$this->treeElem->GetCode()})"
            );
        else
            unset($this->treeElem->$name);
    }

    public function GetElemData($name)
    {
        $elemType = $this->treeElem->TreeElemType();
        if ($elemType === "Branch")
            throw new NonLeafException(
                explode("::", __METHOD__ )[1] . "(): 
                Operator can't remove data of '{$elemType}' elem({$this->treeElem->GetCode()})"
            );
        else
            try{
                return $this->treeElem->$name;
            }
            catch (DataNotFoundException $e){
                throw new GetDataException(
                    explode("::", __METHOD__ )[1] . "(): 
                    Data '{$name}' doesn't exist in elem({$this->treeElem->GetCode()})", $e
                );
            }
    }

    public function GetAllData () : array
    {
        $elemType = $this->treeElem->TreeElemType();
        if ($elemType === "Branch")
            throw new NonLeafException(
                explode("::", __METHOD__ )[1] . "(): 
                Operator can't return data of '{$elemType}' elem({$this->treeElem->GetCode()})"
            );
        else
            return $this->treeElem->GetData();
    }

    public function IsDataOf ($name) : bool
    {
        $elemType = $this->treeElem->TreeElemType();
        if ($elemType === "Branch")
            throw new NonLeafException(
                explode("::", __METHOD__ )[1] . "(): 
                Operator can't inspect data of '{$elemType}' elem({$this->treeElem->GetCode()})"
            );
        else
            return isset($this->treeElem->$name);
    }
}