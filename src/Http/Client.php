<?php

namespace Jinas\Covid19\Http;

use GuzzleHttp\Client as GuzzleClient;

class Client
{
    protected $client;

    public function __construct()
    {
        $this->client = new GuzzleClient();
    }

    /**
     * get.
     *
     *  Guzzle http driver for sending api request
     *
     * @param mixed $endpoint
     *
     * @return array
     */
    public function get(string $endpoint): array
    {
        $response = $this->client->request('Get', $endpoint);

        return json_decode($response->getBody(), true);
    }
}
