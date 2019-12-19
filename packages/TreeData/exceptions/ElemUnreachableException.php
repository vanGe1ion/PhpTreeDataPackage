<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 29.11.2019
 * Time: 16:03
 */

namespace TreeData\exceptions;


use TreeData\traits\TException;

class ElemUnreachableException extends NavigatorException
{
    use TException;
}