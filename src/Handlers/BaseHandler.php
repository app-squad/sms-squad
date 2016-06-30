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
use smsSquad\Models\RestErrorDTO;

class BaseHandler
{
    public $response;
    
    protected function responseGood()
    {
        $sc = $this->response->response_code;
        
        if ($sc == 200) {

            return true;

        } elseif ($sc == 400) {

            $restError  = RestErrorDTO::newFromResponse($this->response);
            throw new ValidationException('Validation Error', 400, null, $restError);

        } elseif ($sc == 401) {

            throw new ValidationException('Unauthorised', 401);

        } elseif ($sc == 403) {

            throw new ValidationException('Forbidden', 403);

        } elseif ($sc == 404) {

            throw new ValidationException('Not Found', 404);

        } else {

            throw new ServerException('Server Responded with an Error', $this->response->response_code);

        }
    }
    
}