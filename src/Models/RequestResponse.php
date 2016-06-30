<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 12:13 PM
 */

namespace smsSquad\Models;


class RequestResponse
{
    public $request_url;
    public $request_type;
    public $request_header;
    public $request_body;
    public $total_time;
    public $response_code;
    public $response_body;

    public function __construct() { }
}