<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 26.11.2019
 * Time: 14:14
 */

namespace TreeData;


use TreeData\objects\{
    Leaf,
    Branch,
    Node,
    Vacant,
    Navigator,
    Operator,
    Map
};

class TreeData
{
    public $tree;
    private $navigator;
    private $operator;
    private $map;

    private $masterFields = [];
    private $slaveFields = [];


    public function __construct(array $table, array $masterFields, string $rootCode)
    {
        $this->tree = new Branch($rootCode);
        $this->masterFields["code"] = $masterFields[0];
        $this->masterFields["pCode"] = $masterFields[1];
        $this->TableNormalize($table);
        $this->tree->SetChildren($this->TreeRecurse($rootCode, $table));
        $this->navigator = new Navigator($this->tree);
        $this->OperatorRefresh();
    }

    private function TreeRecurse($parent, array &$normalizedTable){
        $currentChilds = $this->FindChildrenOf($parent, $normalizedTable);
        $result = [];

        foreach ($currentChilds as $code) {
            $record = $normalizedTable[$code];
            unset($record[$this->masterFields["pCode"]]);

            $data = [];
            foreach ($record as $key => $value){
                if(!in_array($key, $this->slaveFields))
                    $this->slaveFields[] = $key;
                if($value != null && $value != "")
                    $data[$key] = $value;
            }

            $children = $this->TreeRecurse($code, $normalizedTable);

            $elem = null;
            if(count($data) > 0) {
                if (count($children) > 0)
                    $elem = new Node($code, $data, $children);
                else
                    $elem = new Leaf($code, $data);
            }
            else
                if (count($children) > 0)
                    $elem = new Branch($code, $children);
                else
                    $elem = new Vacant($code);

            $result[$code] = $elem;
        }

        return $result;
    }

    private function TableNormalize(array &$table)
    {
        $result = [];
        foreach ($table as $record) {
            $newRecord = $record;
            unset($newRecord[$this->masterFields["code"]]);
            $result[$record[$this->masterFields["code"]]] = $newRecord;
        }
        $table = $result;
    }

    //todo mapping?
    private function FindChildrenOf($pCode, array &$table): array
    {
        $result = [];
        foreach ($table as $code => $record)
            if($record[$this->masterFields["pCode"]] == $pCode)
                $result[] = $code;
        return $result;
    }

    private function OperatorRefresh()
    {
        $this->operator = new Operator($this->tree);
    }

    public function toJSON()
    {
        return json_encode($this->tree);
    }

    public function fromJSON()
    {
        //todo
    }

    public function toTable()
    {
        $result = [];
        $fields = [
            "master" => $this->masterFields,
            "slave" => $this->slaveFields
        ];
        $this->tree->toTableBranch($result, $fields);
        return $result;
    }
}