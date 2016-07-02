<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 11:25 AM
 */

namespace smsSquad\Exceptions;


class ServerException extends \Exception
{
    public function __construct($message, $code, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}