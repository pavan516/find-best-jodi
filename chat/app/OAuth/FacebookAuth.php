<?php

namespace App\OAuth;

use Facebook\Facebook;

class FacebookAuth {

    protected $client;
    protected $helper;
    protected $permissions;
    protected $loginUrl;
    protected $accesstoken;
    protected $userNode;
    protected $response;
    protected $redirect_uri;
    public function __construct($app_id, $app_secret, $graph,$redirect_uri, $scopes)
    {
        
    }
    public function getFacebookAccessToken()
    {
        
    }
    public function setFacebookAccessToken($accesstoken)
    {
      
    }
    public function getGraph()
            
    {   
        
    }
    public function getFacebookAuthUrl()
    {
        
    }
}