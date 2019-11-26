<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:47
 */

namespace classes\treedata;


class Node implements ITreeData
{
    use TIndex, TNode;

    public function __construct(string $code, array $path = [], array $data = [])
    {
        $this->InitIndex($code, $path);
        $this->InitNode($data);
    }

    public function __clone()
    {
        return new Node($this->code, $this->path, $this->data);
    }
}