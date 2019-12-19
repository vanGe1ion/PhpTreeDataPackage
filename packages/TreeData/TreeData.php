<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 26.11.2019
 * Time: 14:14
 */

namespace TreeData;


use TreeData\objects\{Leaf, Branch, Node};

use classes\PgSql;

class TreeData
{
//    public $source;
//    public $drifter;
//
//    private $codePropName;
//    private $pCodePropName;
//    private $dataFields;
//
//    private $querySet = [];
//
//    private $dataMaskFun;
//
//
//    public function __construct(PgSql $pg, array $dataFields, string $queryTarget, string $rootCode, string $dataMaskFun = "")
//    {
//        $this->source = new Branch($rootCode, []);
//        $this->ResetDrifter();
//
//        $this->codePropName = $dataFields[0];
//        $this->pCodePropName = $dataFields[1];
//        unset($dataFields[0], $dataFields[1]);
//        $this->dataFields = $dataFields;
//
//        $queryFields = "";
//        foreach($this->dataFields as $field)
//            $queryFields .= ", {$field}";
//        $this->querySet["select"] = "SELECT {$this->codePropName}{$queryFields} FROM {$queryTarget} WHERE {$this->pCodePropName} = $1";
//
//        $this->querySet["insert"] = "INSERT INTO {queryTarget} ({$this->codePropName}, {$this->pCodePropName}) VALUES ($1, $2)";
//
//        $queryFields = "";
//        for ($i = 1; $i < count($this->dataFields) + 1; ++$i)
//            $queryFields .= ($i == 1 ? "" : ", ") . "{$this->dataFields[$i + 1]} = \${$i}";
//        $this->querySet["update"] = "UPDATE {queryTarget} SET {$queryFields} WHERE {$this->codePropName} = {NodeTarget}";
//
//        $this->dataMaskFun = $dataMaskFun;
//
//        $this->source->SetChildren($this->TreeRecurse($pg, $rootCode));
//    }
//
//    public function TreeRecurse(PgSql $pg, $parent){
//        $pg->ParamExecute($this->querySet["select"], [$parent]);
//        $nodes = $pg->ToArray(PGSQL_ASSOC);
//        $resultArray = [];
//        foreach ($nodes as $nodeData) {
//            $node = null;
//
//            $data = $nodeData;
//            unset($data[$this->codePropName]);
//            if($this->dataMaskFun != "")
//                ($this->dataMaskFun)($data);
//
//            $currentCode = $nodeData[$this->codePropName];
//            $children = $this->TreeRecurse($pg, $currentCode);
//
//            if(count($data) > 0) {
//                if (count($children) > 0)
//                    $node = new Node($currentCode, $data, $children);
//                else
//                    $node = new Leaf($currentCode, $data);
//            }
//            else
//                $node = new Branch($currentCode, $children);
//
//            array_push($resultArray, $node);
//        }
//        return $resultArray;
//    }
//
//    public function TreeSave(PgSql $pg, string $queryTarget){
//        $newQuerySet = $this->querySet;
//        unset($newQuerySet["select"]);
//        $newQuerySet["insert"] = str_replace("{queryTarget}", $queryTarget, $newQuerySet["insert"]);
//        $newQuerySet["update"] = str_replace("{queryTarget}", $queryTarget, $newQuerySet["update"]);
//
//        foreach ($this->source->GetChildren() as $node)
//            $node->DBSave($pg, $this->source->GetCode(), $newQuerySet);
//    }
//
//    public function SetDataMaskFun(string $dataMaskFun)
//    {
//        $this->dataMaskFun = $dataMaskFun;
//    }

//    public function ResetDrifter()
//    {
//        $this->drifter = new TreeDrifter($this->source);
//    }
}