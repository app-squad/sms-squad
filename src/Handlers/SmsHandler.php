<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 1:26 PM
 */

namespace smsSquad\Handlers;


use smsSquad\Models\WebServiceSendSmsRequest;
use smsSquad\Models\WebServiceSendSmsResponse;
use smsSquad\Requester;

class SmsHandler extends BaseHandler
{

    protected $requester;

    public function __construct(Requester $requester)
    {
        $this->requester = $requester;
    }

    public function sendMessage(WebServiceSendSmsRequest $message)
    {
        $url = '/sms/send';

        $this->response = $this->requester->sendRequest($url, 'POST', $message);

        if ($this->responseGood()) {

            return WebServiceSendSmsResponse::newFromResponse($this->response);

        } else {

            return null;
        
        }
    }

}