<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 27.11.2019
 * Time: 16:41
 */

namespace TreeData\exceptions;


trait TException
{
    public function __construct(string $message, int $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        $previous = $this->getPrevious();
        return  __CLASS__ . ": [{$this->code}]: {$this->message} in {$this->file} (line {$this->line})" . ($previous ? "<br>From -> {$previous}" : "");
    }
}