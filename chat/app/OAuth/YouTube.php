<?php 

namespace App\OAuth;

use Google_Client;
use Google_Service_YouTube;
use Google_Service_YouTube_ResourceId;
use Google_Service_YouTube_SubscriptionSnippet;
use Google_Service_YouTube_Subscription;
use Google_Service_Exception;
use Google_Exception;
use Noodlehaus\Config;

/**
*  YouTube
*/
class YouTube
{
    public $client;
    protected $guzzle;
    protected $config;
    protected $youtube;

    function __construct(Google_Client $googleClient = null, Config $config)
    {

    }
    public function getAuthUrl()
    {
       
    }
    public function setTokens($token_array)
    {

    }
    public function unsetTokens()
    {

    }
    public function setToken($token)
    {

    }
    public function getTokens($code, $state, $callback)
    {

    }

    public function getChannels($access_token,$callback)
    {
        
    }
    public function subscribe($channel_id)
    {
        
        
    }

 
}