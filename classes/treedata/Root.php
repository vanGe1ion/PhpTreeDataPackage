<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 25.11.2019
 * Time: 12:47
 */

namespace classes\treedata;


class Root implements ITreeData
{
    use TIndex, TRoot;

    public function __construct(string $code, array $path = [], array $children = [])
    {
        $this->InitIndex($code, $path);
        $this->InitRoot($children);
    }

    public function __clone()
    {
        return new Root($this->code, $this->path, $this->childArray);
    }

}