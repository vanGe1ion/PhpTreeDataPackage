<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 29.11.2019
 * Time: 14:50
 */

namespace exceptions;


use Exception;

trait TException
{
    public function __construct(string $message, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        $previous = $this->getPrevious();
        return  __CLASS__ . ": [{$this->code}]: {$this->message} in {$this->file} (line {$this->line})" . ($previous ? "<br>From -> {$previous}" : "");
    }
}