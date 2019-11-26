<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:48
 */

namespace classes\treedata;


use classes\PgSql;

class Tree implements ITreeData
{
    use TIndex, TNode, TRoot {
        TNode::DBSave as private SaveNode;
        TRoot::DBSave as private SaveRoot;
    }

    public function __construct(string $code, array $path = [], array $data = [], array $children = [])
    {
        $this->InitIndex($code, $path);
        $this->InitNode($data);
        $this->InitRoot($children);
    }

    public function __clone(){
        return new Tree($this->code, $this->path, $this->data, $this->childArray);
    }

    public function DBSave(PgSql $pg, string $query)
    {
        $this->SaveNode($pg, $query);
        $this->SaveRoot($pg, $query);
    }
}