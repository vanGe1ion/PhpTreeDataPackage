<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 27.11.2019
 * Time: 16:41
 */

namespace TreeData\traits;

use Exception;

trait TException
{
    public function __construct(string $message, Exception $previous = null)
    {
        parent::__construct($message, $previous);
    }

    public function __toString()
    {
        $previous = $this->getPrevious();
        return  end(explode("\\", __CLASS__)) . ": {$this->message} in {$this->file} (line {$this->line})" . ($previous ? "<br>From => {$previous}" : "");
    }
}