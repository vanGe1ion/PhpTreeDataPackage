<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 19.12.2019
 * Time: 15:15
 */

namespace TreeData\exceptions;


use TreeData\traits\TException;

class NonBranchException extends OperatorException
{
    use TException;
}