<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 26.11.2019
 * Time: 17:23
 */

namespace TreeData\objects;


use TreeData\interfaces\ITreeElem;
use TreeData\exceptions\{
    ChildNotFoundException,
    ElemUnreachableException,
    NavigatorException,
    OutOfSourceException
};

class Navigator
{
    private $pointer;
    private $elemStack;

    public function __construct(ITreeElem $elem)
    {
        $this->pointer = $elem;
        $this->elemStack = array($elem->GetCode() => $elem);
    }

    public function GetPointedElem(): ITreeElem
    {
        return $this->pointer;
    }

    public function ClimbDown(int $offset = 1)
    {
        for ($i = 0; $i < $offset; ++$i)
            if(count($this->elemStack) > 1) {
                array_pop($this->elemStack);
                $this->pointer = end($this->elemStack);
            }
            else {
                ++$i;
                throw new OutOfSourceException(
                    explode("::", __METHOD__ )[1] . "(): 
                    The pointer tries to go beyond the main root on {$i} iteration."
                );
            }
    }

    public function ClimbCheckpoint(string $index)
    {
        if(array_key_exists($index, $this->elemStack))
            while($this->pointer->GetCode() != $index)
                $this->ClimbDown();
        else
            throw new ElemUnreachableException(
                explode("::", __METHOD__ )[1] . "(): 
                No such elem({$index}) in the current branch"
            );
    }

    public function ClimbUp(string $index)
    {
        $elemType = $this->pointer->TreeElemType();
        if ($elemType === "Leaf")
            throw new ElemUnreachableException(
                explode("::", __METHOD__ )[1] . "(): 
                Elem({$this->pointer->GetCode()}) of type '{$elemType}' can't have children"
            );
        else
            try{
                $child = $this->pointer->GetChild($index);
                $this->pointer = $child;
                $this->elemStack[$index] = $child;
            }
            catch (ChildNotFoundException $e){
                throw new ElemUnreachableException(
                    explode("::", __METHOD__ )[1] . "():
                    Elem({$index}) does not exist in elem({$this->pointer->GetCode()})", $e
                );
            }
    }

    public function ClimbByAddr(array $addr)
    {
        try {
            foreach ($addr as $addrItem)
                $this->ClimbUp($addrItem);
        }
        catch (NavigatorException $e){
            throw new ElemUnreachableException(
                explode("::", __METHOD__ )[1] . "(): 
                The movement of pointer is stopped on elem({$this->pointer->GetCode()}). Child elem({$addrItem}) not/can't be found", $e
            );
        }
    }

    public function GetLevel() : int
    {
        return count($this->elemStack) - 1;
    }

    public function GetPath() : array
    {
        return array_keys($this->elemStack);
    }

    public function PointerReset()
    {
        $this->ClimbDown($this->GetLevel());
    }
}


//    рекурсивный вариант прохода к элементу дерева по адресу
//    public function ClimbByAddr(array $addr)
//    {
//        if(count($addr)){
//            try{
//                $firstKey = array_keys($addr)[0];
//                $firstAddr = $addr[$firstKey];
//                $this->ClimbUp($firstAddr);
//            }
//            catch (NavigatorException $e){
//                throw new ElemUnreachableException(
//                    explode("::", __METHOD__ )[1] . "():
//                    Elem by address ({$firstAddr}) is unreachable. Cascade emersion ", 0, $e
//                );
//            }
//
//            try {
//                unset($addr[$firstKey]);
//                $this->ClimbByAddr($addr);
//            }
//            catch(ElemUnreachableException $e){
//                throw new ElemUnreachableException(
//                    explode("::", __METHOD__ )[1] . "():
//                    Cascade emersion for elem({$firstAddr})", 0, $e
//                );
//            }
//        }
//    }