<?php

include "autoload.php";
use classes\PgSql;
use classes\treedata\{Node, Tree, Root, ITreeData};


function PositionDataMask($data){
    return [
        "name" => $data["name"],
        "is_need_cert" => ($data["is_need_cert"] == "t" ? true : false)
    ];

}

function TreeBuilder(PgSql $pg, string $query, array $path, string $codeIndexName, string $dataMask){
    $pg->ParamExecute($query, [end($path)]);
    $nodes = $pg->ToArray(PGSQL_ASSOC);
    $resultArray = [];
    foreach ($nodes as $nodeData) {
        $node = null;

        $data = $nodeData;
        unset($data[$codeIndexName]);
        $data = $dataMask($data);

        $nextParent = $nodeData[$codeIndexName];
        $nextPath = $path;
        array_push($nextPath, $nextParent);
        $children = TreeBuilder($pg, $query, $nextPath, $codeIndexName, $dataMask);

        if(count($data) > 0) {
            if (count($children) > 0)
                $node = new Tree($nextParent, $path, $data, $children);
            else
                $node = new Node($nextParent, $path, $data);
        }
        else
            $node = new Root($nextParent, $path, $children);

        array_push($resultArray, $node);
    }
    return $resultArray;
}

function SavePositionFilters(ITreeData $tree, PgSql $pg, string $destination){
    $saveQuery = "INSERT INTO {$destination} (code, code_parent, name, is_need_cert) VALUES ($1, $2, $3, $4)";
    foreach ($tree->GetChildren() as $node)
        $node->DBSave($pg, $saveQuery);
}

function ReadPositionFilters(Root $root, PgSql $pg){
    $query = "SELECT code, name, is_need_cert FROM filters.position_filters WHERE code_parent = $1";
    $root->SetChildren(TreeBuilder($pg, $query, [$root->GetCode()],"code", "PositionDataMask"));
}


//$pgSql = new PgSql("172.16.177.81", "I.NAZEMKINA", "48127883", "GIT_RMIS");
$pgSqlMy = new PgSql("localhost", "postgres", "", "frmr");


$positionRoot = new Root(2, [], []);
ReadPositionFilters($positionRoot, $pgSqlMy);
//var_dump($positionRoot);



//unset($pgSql);
unset($pgSqlMy);
?>
<html lang="ru">
<head>

</head>
</html>