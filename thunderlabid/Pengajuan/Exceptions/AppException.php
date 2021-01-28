<?php

namespace Thunderlabid\Pengajuan\Exceptions;

use MessageBag;

class AppException extends \Exception { 

    const UNAUTHORIZED_ACCESS = 1;
    const DATA_NOT_FOUND = 2;
    const DATA_VALIDATION = 3;
    const POLICY_VALIDATION = 4;

    public function __construct($message = null, $code = 0, Exception $previous = null)
    {
    	parent::__construct(null, $code, $previous);

    	if (is_array($message))
    	{
    		$this->message = new MessageBag($message);
    	}
    	else
    	{
    		$this->message = $message;
    	}
    }


}
