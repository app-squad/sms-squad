<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 1:50 PM
 */

namespace smsSquad\Models;

require_once (dirname(__DIR__) . '/helpers.php');

class Link
{
    public $templated;
    public $rel;
    public $href;

    public function __construct($templated, $rel, $href)
    {
        $this->templated    = $templated;
        $this->rel          = $rel;
        $this->href         = $href;
    }

    public static function newFromJSON($jsonString)
    {
        if (empty($jsonString) || $jsonString == 'null') return null;

        $object = json_decode($jsonString);

        return new self(
            ifset($object->templated),
            ifset($object->rel),
            ifset($object->href)
        );
    }
}