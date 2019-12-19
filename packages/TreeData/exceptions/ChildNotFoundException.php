<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 27.11.2019
 * Time: 15:07
 */

namespace TreeData\exceptions;


use TreeData\traits\TException;

class ChildNotFoundException extends BranchException
{
    use TException;
}