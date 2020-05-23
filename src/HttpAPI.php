<?php

namespace VisitorInfo;


class HttpAPI extends HttpVistorInfo
{
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
     * @param $ip string
     * @return array|string
     */
    public function getGeoInfo($ip)
    {
        $response = $this->client->{$this->requestMethod}($this->geoIpApiUrl, ['query' => ['ip' => $ip]]);

        return $this->convertJsonResponseToArray($response);
    }

    /**
     * @param $ip string
     * @return array|string
     */
    public function getProviderInfo($ip)
    {
        $response = $this->client->{$this->requestMethod}($this->providerIpApiUrl, ['query' => ['ip' => $ip]]);

        return $this->convertJsonResponseToArray($response);
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
    public function getHostingInfo($domain)
    {
        $response = $this->client->{$this->requestMethod}($this->hostingApiUrl, ['query' => ['site' => $domain]]);

        return $this->convertJsonResponseToArray($response);
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