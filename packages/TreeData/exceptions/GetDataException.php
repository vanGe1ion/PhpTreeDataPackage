<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 19.12.2019
 * Time: 15:58
 */

namespace TreeData\exceptions;


use TreeData\traits\TException;

class GetDataException extends OperatorException
{
    use TException;
}