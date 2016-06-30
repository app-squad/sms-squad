<?php

namespace smsSquad\Handlers;

use smsSquad\Models\WebServiceMessage;
use smsSquad\Requester;

class MessageHandler extends BaseHandler
{

    protected $requester;

    public function __construct(Requester $requester)
    {
        $this->requester = $requester;
    }

    public function getMessage($id)
    {
        $url = '/messages/' . $id;

        $this->response = $this->requester->sendRequest($url);

        if ($this->responseGood()) {

            return WebServiceMessage::newFromResponse($this->response);

        } else {

            return null;

        }
    }

}