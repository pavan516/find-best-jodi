<?php
    
    return [
        'name' => 'development',
        'app' => [
            'hash' => [
                'algo' => PASSWORD_BCRYPT,
                'cost' => 10
            ],
            'domain' => '',
            'name' => '',
            'admin' => 'Adnan Hussain Turki',
            'admin-email' => "adnan@myphpnotes.tk",
            'show_error_detail' => true,
            'timezone' => "UTC",
            'developer' => [
                        'name' => "Adnan Hussain Turki",
                        'email' => "adnan@myphpnotes.com"
                    ],
            
        ],
        'email' => [
            'noreply' => [ ''],
        ],
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'name' => 'pavankum_findbestjodi',
            'username' => 'pavankum_imhskal',
            'password' => ')xI6FhhFTAT7',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',

        ],
      
        'mail' => [
            'smtp_auth' => true,
            'smtp_secure' => 'ssl',
            'host' => '',
            'username' => '',
            'password' => '',
            'port' => 465,
            'html' => true,
        ],
        'twig' => [
            'cache' => false,
        ],
        'csrf' => [
            'session' => 'csrf_token'
        ],
        'google' => [
            'client' => "",
            'secret' => "",
            'redirect_uri' => "",
            'scopes' => ['', ''],
        ],
        'facebook' => [
            'app_id' => "",
            'app_secret' => "",
            'redirect_uri' => "",
            'default_graph_version' => "v2.9",
            'scopes' => [ 'public_profile' , 'email' ],
        ],
        'twitter' => [
            'consumer_key' => "",
            'consumer_secret' => "",
            'redirect_uri' => "http://slimauth.org/oauth/twitter/callback",
        ],
        'youtube' => [
            'key' => '',
            'secret' => '',
            'callback1' => '',
        ]



];