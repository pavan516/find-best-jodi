<?php

namespace App\OAuth;

use Google_Client;

/**
* Google Authentication Class
*/


class GoogleAuth
{
    protected $client;
    protected $guzzle;
    public function __construct(Google_Client $google_client, $client_id, $client_secret, $redirectUri, $scopes)
    {

       $this->client = $google_client;
       if ($this->client) {
           $this->client->setClientId($client_id);
           $this->client->setClientSecret($client_secret);
           $this->client->setRedirectUri($redirectUri);
           $this->client->setScopes($scopes);
       }
    }
    public function getAuthUrl()
    {
        return $this->client->createAuthUrl();
    }
    public function setToken($token)
    {
        $_SESSION['access_token'] = $token;
        $this->client->setAccessToken($token);
    }
    public function getPayload()
    {
        $token = $this->client->getAccessToken();
        $token_array = $this->client->verifyIdToken($token['id_token']);
        if ($token_array) {
            return $token_array;
        }
        return false;
    }
    public function checkRedirectCodeAndGetPayload()
    {
        if (isset($_GET['code'])) {
            $authenticate = $this->client->authenticate($_GET['code']);
            $this->setToken($this->client->getAccessToken());
            $payload = $this->getPayload();
            return json_decode(json_encode($payload));
        }
        return false;
    }


}