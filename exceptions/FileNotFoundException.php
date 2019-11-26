<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 19.11.2019
 * Time: 14:59
 */

namespace exceptions;

use Exception, Throwable;

class FileNotFoundException extends Exception
{
    public function __construct(string $message, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message} in {$this->file} (line {$this->line})\n";
    }

}