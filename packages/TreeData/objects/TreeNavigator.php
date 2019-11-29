<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 26.11.2019
 * Time: 17:23
 */

namespace TreeData\objects;

use TreeData\exceptions\ChildNotFoundException;
use TreeData\exceptions\ElemUnreachableException;
use TreeData\exceptions\NavigatorException;
use TreeData\exceptions\NotRootException;
use TreeData\exceptions\OutOfSourceException;
use TreeData\interfaces\ITreeElem;

class TreeNavigator
{
    public $pointer;
    public $nodeStack;

    public function __construct(ITreeElem $node)
    {
        $this->pointer = $node;
        $this->nodeStack = array($node->GetCode() => $node);
    }

    public function ClimbUp(string $index)
    {
        $treeType = $this->pointer->TreeElemType();
        if ($treeType === "Root" || $treeType === "Tree"){
            try{
                $child = $this->pointer->GetChild($index);
                $this->pointer = $child;
                $this->nodeStack[$index] = $child;
            }
            catch (ChildNotFoundException $e){
                throw new ElemUnreachableException(
                    explode("::", __METHOD__ )[1] . "(): 
                    The movement of pointer is stopped on elem({$this->pointer->GetCode()}).", 0, $e
                );
            }
        }
        else
            throw new NotRootException(
                explode("::", __METHOD__ )[1] . "(): 
                Type '{$treeType}' can't have children");
    }

    public function ClimbDown(int $offset = 1){
        for ($i = 0; $i < $offset; ++$i)
            if(count($this->nodeStack) > 1) {
                array_pop($this->nodeStack);
                $this->pointer = end($this->nodeStack);
            }
            else {
                ++$i;
                throw new OutOfSourceException(
                    explode("::", __METHOD__ )[1] . "(): 
                    The pointer tries to go beyond the main root on {$i} iteration."
                );
            }
    }

    public function ClimbCheckpoint(string $index){
        if(array_key_exists($index, $this->nodeStack))
            while($this->pointer->GetCode() != $index)
                $this->ClimbDown();
        else
            throw new ElemUnreachableException(
                explode("::", __METHOD__ )[1] . "(): 
                No such node({$index}) in the current branch"
            );
    }

    public function ClimbByAddr(array $addr)
    {
        if(count($addr)){
            try{
                $firstKey = array_keys($addr)[0];
                $firstAddr = $addr[$firstKey];
                $this->ClimbUp($firstAddr);
            }
            catch (NavigatorException $e){
                throw new ElemUnreachableException(
                    explode("::", __METHOD__ )[1] . "(): 
                    Elem by address ({$firstAddr}) is unreachable. Cascade emersion", 0, $e
                );
            }

            try {
                unset($addr[$firstKey]);
                $this->ClimbByAddr($addr);
            }
            catch(ElemUnreachableException $e){
                throw new ElemUnreachableException(
                    explode("::", __METHOD__ )[1] . "(): 
                    Cascade emersion for elem({$firstAddr})", 0, $e
                );
            }
        }
    }

    public function GetLevel()
    {
        return count($this->nodeStack) - 1;
    }

    public function PointerReset()
    {
        $this->ClimbDown($this->GetLevel());
    }

    public function GetPath()
    {
        return array_keys($this->nodeStack);
    }
}