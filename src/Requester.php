<?php
/**
 * Created by PhpStorm.
 * User: Willem
 * Date: 2016-06-30
 * Time: 11:37 AM
 */

namespace smsSquad;


use smsSquad\Exceptions\CommunicationsException;
use smsSquad\Models\RequestResponse;

class Requester
{
    protected $credentials;
    protected $request;
    protected $base_url = 'https://www.zoomconnect.com/zoom/api/rest/v1';


    public function __construct($email, $token)
    {
        $this->credentials  = "$email:$token";
        $this->request      = new RequestResponse();
    }


    public function sendRequest($url, $requestType = 'GET', $payloadObject = null)
    {
        $this->request                  = new RequestResponse();
        $this->request->request_url     = $this->base_url . $url;
        $this->request->request_type    = $requestType;
        $this->request->request_body    = $this->JsonEncodeObject($payloadObject);
        $this->request->request_header  = $this->createHeader();

        $ch = curl_init();

        try {

            curl_setopt_array($ch, $this->createOptions());

            $result = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new CommunicationsException(curl_error($ch), curl_errno($ch));
            }

            // Success - Add Response to Request Object
            $this->request->response_code       = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $this->request->response_body       = $result;
            $this->request->total_time          = curl_getinfo($ch, CURLINFO_TOTAL_TIME);

        } catch (\Exception $e) {

            throw new CommunicationsException('Failed to Execute cUrl Request');

        } finally {

            curl_close($ch);

        }

        return $this->request;
    }


    /**
     * Creates the Options for the curl Request
     *
     * @return array
     */
    private function createOptions()
    {
        return [
            CURLOPT_URL                 => $this->request->request_url,
            CURLOPT_CUSTOMREQUEST       => $this->request->request_type,
            CURLOPT_RETURNTRANSFER      => true,
            CURLOPT_HTTPHEADER          => $this->request->request_header,
            CURLOPT_POSTFIELDS          => $this->request->request_body
        ];
    }

    /**
     * Creates the Header for the curl Request
     *
     * @return array
     */
    private function createHeader()
    {
        $header = [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($this->credentials)
        ];

        if (!empty($this->request->request_body)) {
            array_push($header, 'Content-Length: ' . strlen($this->request->request_body));
        }
        
        return $header;
    }

    /**
     * Json Encodes the Object - After Stripping null Variables from it.
     *
     * @param $object
     * @return string
     */
    private function JsonEncodeObject($object)
    {
        $object = (object) array_filter((array) $object);
        return json_encode($object);
    }

}