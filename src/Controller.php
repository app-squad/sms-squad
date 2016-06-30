<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 1:19 PM
 */

namespace smsSquad;


use smsSquad\Handlers\AccountHandler;
use smsSquad\Handlers\SmsHandler;

class Controller
{
    public $email;
    public $token;

    public $account;
    public $contacts;
    public $context;
    public $messages;
    public $sms;
    public $templates;

    protected $requester;

    public function __construct($email, $token)
    {
        $this->email        = $email;
        $this->token        = $token;
        $this->requester    = new Requester($email, $token);

        $this->account      = new AccountHandler($this->requester);
        $this->sms          = new SmsHandler($this->requester);

    }

}