<?php

namespace VisitorInfo;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

abstract class HttpVistorInfo
{
    /**
     * Request method for API.
     *
     * @var string
     */
    protected $requestMethod = 'GET';

    /**
     * Guzzle http client.
     *
     * @var Client
     */
    protected $client;

    /**
     * AbstractIpInfoService constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param Response $response
     * @return array|string
     */
    protected function convertJsonResponseToArray(Response $response)
    {
        return json_decode($response->getBody()->getContents(), true) ? : 'Failed to get data. Request limit exceeded.';
    }
}