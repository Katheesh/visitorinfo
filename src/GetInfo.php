<?php

namespace VisitorInfo;

use GuzzleHttp\Client;

class GetInfo 
{

    /**
     * Request method for API.
     *
     * @var string
     */
    protected $requestMethod = 'GET';

    /**
     * Url for "Geo-Ip API" service.
     * Parameter: ip=*.*.*.*
     *
     * @var string
     */
    private $geoIpApiUrl = 'http://api.2ip.ua/geo.json';

    /**
     * Url for "Provider-Ip API" service.
     * Parameter: ip=*.*.*.*
     *
     * @var string
     */
    private $providerIpApiUrl = 'http://api.2ip.ua/provider.json';

    /**
     * Url for "Hosting API" service.
     * Parameter: site="domain.com"
     *
     * @var string
     */
    private $hostingApiUrl = 'http://api.2ip.ua/hosting.json';

    /**
     * Url for "Email API" service.
     * Check is email isset.
     * Parameter: email="email@email.email"
     *
     * @var string
     */
    private $emailApiUrl = 'http://api.2ip.ua/email.txt';

    /**
     * Guzzle http client.
     *
     * @var Client
     */
    protected $client;

    /**
     * VisitorInfoService constructor.
     *
     * @param Client $client
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param $ip string
     * @return array|string
     */
    public function getGeoInfo()
    {

        //$client = new Client();

        $response = $this->client->request($this->requestMethod, $this->geoIpApiUrl);

        //echo $response->getStatusCode();
        // "200"
        //echo $response->getHeader('content-type')[0];
        // 'application/json; charset=utf8'
        //echo $response->getBody();

        //$response = $this->client->{$this->requestMethod}($this->geoIpApiUrl, ['query' => ['ip' => $ip]]);

        return $response->getBody();
    }

    /**
     * @param $ip string
     * @return array|string
     */
    public function getProviderInfo()
    {
        $response = $this->client->{$this->requestMethod}($this->providerIpApiUrl);

        return $response->getBody();
    }

    /**
     * Return composition of geo and provider info by IP.
     *
     * @param $ip
     * @return array
     */
    public function getCompositionInfoForIp($ip)
    {
        return [
            'geo' => $this->getGeoInfo($ip),
            'provider' => $this->getProviderInfo($ip),
        ];
    }

    /**
     * @param $domain string
     * @return array|string
     */
    public function getHostingInfo()
    {
        $response = $this->client->{$this->requestMethod}($this->hostingApiUrl);

        return $response->getBody();
    }

    /**
     * @param $email string
     * @return boolean
     */
    public function isEmailExists($email)
    {
        $response = $this->client->{$this->requestMethod}($this->emailApiUrl, ['query' => ['email' => $email]]);

        return $response->getBody()->getContents() == 'true';
    }
}