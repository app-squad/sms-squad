<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 11:20 AM
 */

namespace smsSquad\Exception;


class ValidationException extends \Exception
{
    public $restErrorDTO;
    
    public function __construct($message, $code, \Exception $previous = null, $restError = null)
    {
        $this->restErrorDTO = $restError;

        parent::__construct($message, $code, $previous);
    }

    public function getRestError()
    {
        return $this->restErrorDTO;
    }
}