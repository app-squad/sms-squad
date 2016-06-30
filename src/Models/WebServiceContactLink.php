<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 7:45 PM
 */

namespace smsSquad\Models;

require_once (dirname(__DIR__) . '/helpers.php');

class WebServiceContactLink
{
    public $contactId;
    public $links;

    public function __construct()
    {
    }

    public static function newFromJSON($jsonString)
    {
        if (empty($jsonString) || $jsonString == 'null') return null;

        $object = json_decode($jsonString);

        $contactLink    = new self();
        $links          = [];

        $contactLink->contactId = ifset($object->contactId);

        foreach($object->links as $link) {
            array_push($links, new Link(ifset($link->templated), ifset($link->rel), ifset($link->href)));
        }

        $contactLink->links = $links;

        return $contactLink;
    }
}