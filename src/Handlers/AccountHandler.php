<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 1:26 PM
 */

namespace smsSquad\Handlers;


use smsSquad\Models\WebServiceAccount;
use smsSquad\Requester;

class AccountHandler extends BaseHandler
{

    protected $requester;

    public function __construct(Requester $requester)
    {
        $this->requester = $requester;
    }

    public function getCreditBalance()
    {
        $url = '/account/balance';

        $this->response = $this->requester->sendRequest($url);

        if ($this->responseGood()) {

            return WebServiceAccount::newFromJSON($this->response);

        } else {

            return null;
        
        }
    }

}