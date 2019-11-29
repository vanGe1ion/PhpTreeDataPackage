<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 27.11.2019
 * Time: 16:18
 */

namespace TreeData\exceptions;


use Exception;

class TreeDataException extends Exception{

    function __construct($message = '', $code = 0, Exception $previous = null) {
        parent::__construct($message, 0, $previous);
    }
}