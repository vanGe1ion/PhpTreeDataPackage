<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:43
 */

namespace TreeData\traits;


use TreeData\exceptions\DataNotFoundException;

trait TLeaf
{
    private $leafData;


    public function SetData(array $leafData)
    {
        $this->leafData = $leafData;
    }

    public function GetData()
    {
        return $this->leafData;
    }

    public function __get( $name )
    {
        if ( array_key_exists( $name, $this->leafData ) )
            return $this->leafData[$name];
        else
            throw new DataNotFoundException(
                explode("::", __METHOD__ )[1] . "(): 
                    Data({$name}) not found in elem({$this->code})"
            );
    }

    public function __set( $name, $value )
    {
        $this->leafData[$name] = $value;
    }

    public function __isset($name)
    {
        if(isset($this->leafData[$name]))
            return true;
        return false;
    }

    public function __unset($name)
    {
        unset($this->leafData[$name]);
    }

    public function toTableLeaf($slaveFields)
    {
        $result = [];
        foreach ($slaveFields as $slave)
            if(isset($this->leafData[$slave]))
                $result[$slave] = $this->leafData[$slave];
            else
                $result[$slave] = null;

        return $result;
    }
}