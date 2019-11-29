<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 29.11.2019
 * Time: 14:49
 */

namespace exceptions;


class PGConnectionRefusedException extends BaseException
{
    use TException;
}