<?php

namespace Dwijonarko\PHPKirimemail;

use GuzzleHttp\Client;

class KontakApi
{

    private const BASEAPIURL = "https://appstaging.kirim.email/api/v3";

    protected $username;
    protected $api_token;
    protected $header;
    protected $body;

    /**
     * set configuration username and api token
     * @param array $config['username','api_token']
     */
    public function setConfig($config)
    {
        if (empty($config['username']) || empty($config['api_token'])) {
            throw new \Exception("Username and Api Token must be set");
        }
        $this->username = $config['username'];
        $this->api_token = $config['api_token'];
    }

    /**
     * set header for request
     */
    protected function setHeader(){
        $this->header = [
            'Auth-id' => $this->username,
            'Auth-token' => $this->generateToken(),
            'Timestamp' => time()
        ];
    }

    /**
     * KIRIM.EMAIL APIs are secured using API keys. 
     * You can get the API key from the application page. 
     * Once you have the API key, you must use it generate a token. 
     * You must send your username and the API key as a request to get a authroziation token.
     * @param string $username
     * @param string $apiToken
     * @return string
     *
     */
    public function generateToken()
    {
          if (empty($this->username) || empty($this->api_token)) {
            throw new \Exception("Username and Api Token must be set");
        }
        $time = time();
        return hash_hmac("sha256", $this->username . "::" . $this->api_token . "::" . $time, $this->api_token);
    }

    public function curl($url, $method, $header = [], $body = [])
    {
        $client = new Client();
        $response = $client->request($method, $this->getApiUrl($url), [
            'headers' => $header,
            'form_params' => $body
        ]);
        return $response->getBody()->getContents();
    }

    protected function getApiUrl($url)
    {
        return self::BASEAPIURL . $url;
    }
}
