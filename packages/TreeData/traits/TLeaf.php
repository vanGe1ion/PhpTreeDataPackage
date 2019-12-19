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
        //if ( $this->IsMagic($name) )
            if ( array_key_exists( $name, $this->leafData ) )
                return $this->leafData[$name];

        throw new DataNotFoundException(
            explode("::", __METHOD__ )[1] . "(): 
                Data({$name}) not found in elem({$this->code})"
        );
    }

    public function __set( $name, $value )
    {
        //if ( $this->IsMagic($name) )
            $this->leafData[$name] = $value;
    }

    public function __isset($name)
    {
        //if ($this->IsMagic($name))
            if(isset($this->leafData[$name]))
                return true;
        return false;
    }

    public function __unset($name)
    {
        //if ($this->IsMagic($name))
            unset($this->leafData[$name]);
    }

//    private function IsMagic($name)
//    {
//        return $name != "code";
//    }

    //todo преобразовать в ToArray
//    public function DBSaveNode(PgSql $pg, string $query)
//    {
//        $queryParams = [];
//
//        foreach ($this->leafData as $value) {
//            if(gettype($value) == "boolean")
//                array_push($queryParams, ($value === true ? "t" : "f"));
//            else
//                array_push($queryParams, $value);
//        }
//
//        $pg->ParamExecute($query, $queryParams);
//    }
}