<?php

include "autoload.php";
include "packages/TreeData/TreeDataAutoload.php";

use classes\PgSql;
use TreeData\TreeData;
use TreeData\objects\{Tree, Root, Node, TreeNavigator};



function MyDataMask(&$data){
    $data["is_need_cert"] = ($data["is_need_cert"] == "t" ? true : false);
}

//$pgSql = new PgSql("172.16.177.81", "I.NAZEMKINA", "48127883", "GIT_RMIS");
$pgSqlMy = new PgSql("localhost", "postgres", "", "frmr");


//$treeData = new TreeData($pgSqlMy, ["code", "code_parent", "name", "is_need_cert"], "filters.position_filters", 2, "MyDataMask");
//var_dump($treeData);
//$treeData->TreeSave($pgSqlMy, "filters.table1");

$tree = new Tree(1, ["name"=>"n1"],[2=>new Root(2, [4=>new Node(4, [])])]);
//
$drifter = new TreeNavigator($tree);
//try{
//    $drifter->ClimbUp(2);
//    $drifter->ClimbUp(4);
////    echo $drifter->GetLevel();
////    $drifter->GoToParent(3);
//    var_dump($drifter->pointer);
//}catch(Exception $e){
//    echo $e;
//}
//$drifter->pointer->name = "nn1";
//$drifter->pointer->GetChild(2)->name = "nn1";
//var_dump($tree);
//
//$child = $tree->GetChildren()[2];
//$child->tree = 123;
//var_dump($child);
//var_dump($tree);

//try {
//    $drifter->GoToChild(2);
//    var_dump($drifter);
//}catch(\TreeData\exceptions\NodeNotFoundException $e){
//    echo $e->getMessage();
//    var_dump( $e->getTraceAsString());
//}catch (\TreeData\exceptions\NotRootException $e){
//    echo $e->getMessage();
//}

//    $drifter->ClimbUp(2);
//    $drifter->ClimbUp(4);
    var_dump($drifter->pointer);
    try {
        $drifter->ClimbDown();
        var_dump($drifter->pointer);
    }catch(\TreeData\exceptions\TreeDataException $e) {
        echo $e;
    }




//unset($pgSql);
unset($pgSqlMy);