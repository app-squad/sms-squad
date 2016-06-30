<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-29
 * Time: 2:13 PM
 */

namespace smsSquad\Models;

require_once (dirname(__DIR__) . '/helpers.php');

class RestErrorDTO
{
    public $code;
    public $developerMessage;
    public $moreInfoUrl;
    public $message;
    public $status;

    public function __construct($code, $developerMessage, $moreInfoUrl, $message, $status)
    {
        $this->code             = $code;
        $this->developerMessage = $developerMessage;
        $this->moreInfoUrl      = $moreInfoUrl;
        $this->message          = $message;
        $this->status           = $status;
    }

    public static function newFromResponse(RequestResponse $response)
    {
        if (empty($response->response_body) || $response->response_body == 'null') return null;

        $object = json_decode($response->response_body);

        return new self(
            ifset($object->code),
            ifset($object->developerMessage),
            ifset($object->moreInfoUrl),
            ifset($object->message),
            ifset($object->status)
        );
    }

}