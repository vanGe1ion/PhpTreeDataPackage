<?php

include "autoload.php";
include "packages/TreeData/TreeDataAutoloader.php";

use classes\PgSql;
use TreeData\objects\{Node, Branch, Leaf, Navigator, Operator};



//function MyDataMask(&$data){
//    $data["is_need_cert"] = ($data["is_need_cert"] == "t" ? true : false);
//}
//$pgSql = new PgSql("172.16.177.81", "I.NAZEMKINA", "48127883", "GIT_RMIS");
//$pgSqlMy = new PgSql("localhost", "postgres", "", "frmr");
//$treeData = new TreeData($pgSqlMy, ["code", "code_parent", "name", "is_need_cert"], "filters.position_filters", 2, "MyDataMask");
//var_dump($treeData);
//$treeData->TreeSave($pgSqlMy, "filters.table1");
//unset($pgSql);
//unset($pgSqlMy);





//$tree = new Node(1, ["name" => "n1"], [
//    2 => new Branch(2, [
//        4 => new Leaf(4, ["some"=>123])
//    ])
//]);
//$drifter = new Navigator($tree);
//
//    var_dump($drifter->pointer);
//    try {
//
//        $drifter->ClimbByAddr([2, 4]);
//
//        var_dump($drifter->pointer);
//    }catch(\TreeData\exceptions\TreeDataException $e) {
//        echo $e;
//    }



//$elem = new Node(1);
//
//$oper = new Operator($elem);
//
//try {
//    $oper->DefineElemForkSet([new Branch(2), new Leaf(3)]);
//    $oper->InsertElemFork(new Node(4));
//    $oper->RemoveElemFork(2);
//    var_dump( $oper->GetElemForks());
//
//    $oper->DefineElemDataSet(["code"=>1, "data"=>2]);
//    $oper->RemoveElemData("code");
//    echo $oper->IsDataOf("data7");
//    $oper->InsertElemData("data4",3);
//    echo $oper->GetElemData("data");
//    var_dump($oper->GetAllData());
//    var_dump($elem);
//}
//catch(\TreeData\exceptions\OperatorException $e){
//    echo($e);
//}
