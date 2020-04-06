<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 10.01.2020
 * Time: 16:30
 */

namespace TreeData\objects;


abstract class TreeElemType
{
    public const VACANT =   0;
    public const LEAF =     1;
    public const BRANCH =   2;
    public const NODE =     3;

    public static function TypeName(int $type)
    {
        switch ($type) {
            case 0:
                return "Vacant";
            case 1:
                return "Leaf";
            case 2:
                return "Branch";
            case 3:
                return "Node";
            default:
                return "";
        }
    }
}