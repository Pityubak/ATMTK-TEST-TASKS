<?php

namespace App;

use Exception;

class ResourceNotFoundException extends Exception
{
    protected $message;

    public function __construct($message)
    {
        parent::__construct();
        $this->message = $message;
    }

    public function __toString()
    {
        return $this->message;
    }
}
