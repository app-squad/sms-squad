<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 7:49 PM
 */

namespace smsSquad\Models;


class WebServiceSendSmsRequest
{
    public $campaign;
    public $recipientNumber;
    public $dateToSend;
    public $dataField;
    public $message;

    public function __construct()
    {
    }

    public static function create($recipientNumber, $message, $dataField = null, $dateToSend = null, $campaign = null)
    {
        $smsRequest = new self();
        $smsRequest->recipientNumber    = $recipientNumber;
        $smsRequest->message            = $message;
        $smsRequest->dataField          = $dataField;
        $smsRequest->dateToSend         = $dateToSend;
        $smsRequest->campaign           = $campaign;

        return $smsRequest;
    }
}