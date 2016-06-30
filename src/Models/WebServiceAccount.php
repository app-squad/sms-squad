<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 1:49 PM
 */

namespace smsSquad\Models;

require_once (dirname(__DIR__) . '/helpers.php');

class WebServiceAccount extends BaseModel
{
    public $links;
    public $creditBalance;

    public function __construct(array $links, $creditBalance, $response)
    {
        $this->links            = $links;
        $this->creditBalance    = $creditBalance;
        $this->response         = $response;
    }

    public static function newFromJSON(RequestResponse $response)
    {
        if (empty($response->response_body) || $response->response_body == 'null') return null;

        $object = json_decode($response->response_body);

        $links = [];
        foreach ($object->links as $link) {
            array_push($links, Link::newFromJSON(json_encode($link)));
        }

        return new self($links, ifset($object->creditBalance), $response);
    }
}