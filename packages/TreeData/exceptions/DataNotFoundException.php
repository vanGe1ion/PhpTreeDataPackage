<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 29.11.2019
 * Time: 16:51
 */

namespace TreeData\exceptions;


use TreeData\traits\TException;

class DataNotFoundException extends LeafException
{
    use TException;
}