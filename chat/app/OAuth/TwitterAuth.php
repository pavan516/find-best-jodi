<?php

namespace App\OAuth;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAuth {

    protected $client;
    protected $consumer_key;
    protected $consumer_secret;
    protected $redirect_uri;
    protected $request_token;

    public function __construct($consumer_key, $consumer_secret, $redirect_uri)
    {   
        $this->consumer_key = $consumer_key;
        $this->consumer_secret = $consumer_secret;
        $this->redirect_uri = $redirect_uri;
        $this->client = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
        
        

    }
    protected function generateAccessToken()
    { 
        return $this->client->oauth('oauth/request_token',['oauth_callback' => $this->redirect_uri]);     
    }
    protected function storeToken()
    {
  


    }
    public function getUrl()
    { 
        $accessToken = $this->storeToken();
       
        
  
          
        return $url;
    }
    protected function verifyToken()
    {

    }
    public function getPayload()
    {

    }
    
}