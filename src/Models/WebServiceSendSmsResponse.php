<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 7:50 PM
 */

namespace smsSquad\Models;

require_once (dirname(__DIR__) . '/helpers.php');

class WebServiceSendSmsResponse extends BaseModel
{
    public $messageId;
    public $error;

    public function __construct($messageId, $error, $response)
    {
        $this->messageId    = $messageId;
        $this->error        = $error;
        $this->response = $response;
    }

    public static function newFromResponse(RequestResponse $response)
    {
        if (empty($response->response_body) || $response->response_body == 'null') return null;

        $object = json_decode($response->response_body);

        return new self(
            ifset($object->messageId),
            ifset($object->error),
            $response
        );
    }
}