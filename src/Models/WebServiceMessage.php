<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 11:29 AM
 */

namespace smsSquad\Models;

require_once (dirname(__DIR__) . '/helpers.php');

class WebServiceMessage
{
    public $messageId;
    public $contact;
    public $messageType;
    public $fromNumber;
    public $toNumber;
    public $numberOfMessages;
    public $creditCost;
    public $dateTimeSent;
    public $dateTimeReceived;
    public $dateTimeScheduled;
    public $messageStatus;
    public $campaign;
    public $userDataField;
    public $deleted;
    public $read;
    public $message;
    public $links;

    public function __construct() {}

    public static function newFromJSON($jsonString)
    {
        $object = json_decode($jsonString);

        $message = new self();
        $message->messageId             = ifset($object->messageId);
        $message->messageType           = ifset($object->messageType);
        $message->fromNumber            = ifset($object->fromNumber);
        $message->toNumber              = ifset($object->toNumber);
        $message->numberOfMessages      = ifset($object->numberOfMessages);
        $message->creditCost            = ifset($object->creditCost);
        $message->dateTimeSent          = ifset($object->dateTimeSent);
        $message->dateTimeReceived      = ifset($object->dateTimeReceived);
        $message->dateTimeScheduled     = ifset($object->dateTimeScheduled);
        $message->messageStatus         = ifset($object->messageStatus);
        $message->campaign              = ifset($object->campaign);
        $message->userDataField         = ifset($object->userDataField);
        $message->deleted               = ifset($object->deleted);
        $message->read                  = ifset($object->read);
        $message->message               = ifset($object->message);

        $message->contact               = WebServiceContactLink::newFromJSON(json_encode($object->contact));
        $message->links                 = [];

        foreach ($object->links as $link) {
            array_push($message->links, Link::newFromJSON(json_encode($link)));
        }

        return $message;
    }
}