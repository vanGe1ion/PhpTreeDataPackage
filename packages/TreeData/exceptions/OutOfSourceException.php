<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 28.11.2019
 * Time: 16:04
 */

namespace TreeData\exceptions;


use TreeData\traits\TException;

class OutOfSourceException extends NavigatorException
{
    use TException;
}