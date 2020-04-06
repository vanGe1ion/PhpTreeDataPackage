<?php

include "autoload.php";
include "packages/TreeData/Autoloader.php";

use classes\PgSql;
use TreeData\objects\{Node, Branch, Leaf, Vacant, Navigator, Operator, Map};
use TreeData\TreeData;


//function MyDataMask(&$data){
//    $data["is_need_cert"] = ($data["is_need_cert"] == "t" ? true : false);
//}
//$pgSql = new PgSql("172.16.177.81", "I.NAZEMKINA", "48127883", "GIT_RMIS");
//$pgSqlMy = new PgSql("10.1.92.80", "postgres", "", "frmr");
//$treeData = new TreeData($pgSqlMy, ["code", "code_parent", "name", "is_need_cert"], "filters.position_filters", 2, "MyDataMask");
//var_dump($treeData);
//$treeData->TreeSave($pgSqlMy, "filters.table1");
//unset($pgSql);
//unset($pgSqlMy);

//$pgSqlMy->QueryExecute("Select * from filters.employee_position");
//$table = $pgSqlMy->ToArray(PGSQL_ASSOC);
//$treeData = new TreeData($table, ["code", "code_parent"], 2);

//var_dump($table);

//var_dump($treeData->toTable());
//unset($pgSqlMy);

$tree = new Node(1, ["name" => "n1"], [
    2 => new Branch(2, [
        4 => new Leaf(4, ["some"=>123]),
        3 => new Vacant(3)
    ])
]);
var_dump($tree);
//$tab = [];
//$tree->toTable($tab,[["code" => "code", "pCode"=>"par"], ["name"]],"null");
//var_dump($tab);
//$nav = new Navigator($tree);

//var_dump($nav->GetPointedElem());
////try {
////
////    $nav->ClimbUp(3);
////
////    var_dump($nav->GetPointedElem());
////}catch(\TreeData\exceptions\TreeDataException $e) {
////    echo $e;
////}



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

//$elem = new \TreeData\objects\Branch(1, [2 => new \TreeData\objects\Leaf(2, [])]);
//
//var_dump($elem->ConvertTo(3));

//$map = new Map(1, [3=>2, 4=>2, 2=>1, 5=>3, 6=>3, 7=>3, 8=>7, 9=>1]);
//var_dump($map->GetPath(8));
//var_dump($map->AddTrack(5, 1));
//$map->RemoveTrack(3);
//var_dump($map);
//var_dump($tree->JsonSerialize());
//var_dump(json_decode(json_encode($tree), true));


?>
<script>
    //console.log( <?//=json_encode($tree)?>);
</script>