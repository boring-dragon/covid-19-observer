<?php
namespace Jinas\Covid19\Http;

use GuzzleHttp\Client as GuzzleClient;

class Client extends GuzzleClient
{

    /**
     * get
     * 
     *  Guzzle http driver for sending api request
     *
     * @param  mixed $endpoint
     * @return array
     */
    public function get(string $endpoint) : array
    {
        $response = $this->request('Get', $endpoint);
        $rawresponse = $response->getBody();
        
        $responseArray = json_decode($rawresponse, true);

        $data = [
            'data' => $responseArray, 
            'status_code' => $response->getStatusCode()
        ];

        return $data;
    }
}
