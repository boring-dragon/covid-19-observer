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
        
        $data = json_decode($rawresponse, true);

        return $data;
    }
}
