<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:43
 */

namespace TreeData\traits;


use classes\PgSql;

trait TNode
{
    private $data;

    private function InitNode(array $data)
    {
        $this->data = $data;
    }

    public function SetNodeData(array $data){
        $this->data = $data;
    }

    public function GetNodeData(){
        return $this->data;
    }

    public function __get( $name ) {
        if ( $this->IsMagic($name) )
            if ( array_key_exists( $name, $this->data ) )
                return $this->data[$name];
        return null;
    }

    public function __set( $name, $value ) {
        if ( $this->IsMagic($name) )
            $this->data[$name] = $value;
    }

    public function __isset($name) {
        if ($this->IsMagic($name))
            if(isset($this->data[$name]))
                return true;
        return false;
    }

    public function __unset($name) {
        if ($this->IsMagic($name))
            unset($this->data[$name]);
    }

    private function IsMagic($name){
        return $name != "code";
    }

    public function DBSaveNode(PgSql $pg, string $query){
        $queryParams = [];

        foreach ($this->data as $value) {
            if(gettype($value) == "boolean")
                array_push($queryParams, ($value === true ? "t" : "f"));
            else
                array_push($queryParams, $value);
        }

        $pg->ParamExecute($query, $queryParams);
    }
}