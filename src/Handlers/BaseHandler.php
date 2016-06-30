<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 1:25 PM
 */

namespace smsSquad\Handlers;


use smsSquad\Exception\ServerException;
use smsSquad\Exception\ValidationException;

class BaseHandler
{
    public $response;
    
    protected function responseGood()
    {
        if ($this->response->response_code == 200) {

            return true;

        } elseif ($this->response->response_code == 400) {

            throw new ValidationException('Validation Error', 400);

        } elseif ($this->response->response_code == 401) {

            throw new ValidationException('Unauthorised', 401);

        } elseif ($this->response->response_code == 403) {

            throw new ValidationException('Forbidden', 403);

        } elseif ($this->response->response_code == 404) {

            throw new ValidationException('Not Found', 404);

        } else {

            throw new ServerException('Server Responded with an Error', $this->response->response_code);

        }
    }
    
}