<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 7:50 PM
 */

namespace smsSquad\Models;

require_once (dirname(__DIR__) . '/helpers.php');

class WebServiceSendSmsResponse
{
    public $messageId;
    public $error;

    public function __construct($messageId, $error)
    {
        $this->messageId    = $messageId;
        $this->error        = $error;
    }

    public static function newFromJSON($jsonString)
    {
        if (empty($jsonString) || $jsonString == 'null') return null;

        $object = json_decode($jsonString);

        return new self(
            ifset($object->messageId),
            ifset($object->error)
        );
    }
}