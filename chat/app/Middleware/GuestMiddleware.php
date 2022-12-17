<?php

namespace App\Middleware;
use App\Interfaces\FlashInterface as Flash;
use App\Models\Auth;
use App\Models\User;


use Slim\Router;

class GuestMiddleware extends Middleware
{
    protected $auth;
    protected $flash;
    protected $router;
    protected $user;
    public function __construct( Router $router, Flash $flash ,Auth $auth, User $user)
    {
        $this->auth = $auth;
        $this->router = $router;
        $this->flash = $flash;
        $this->user = $user;

    }
    public function __invoke($request, $response,$next)
    {
        //check if the user is signed in
        if ($this->auth->check()) {
            //$this->flash->addMessage('info', 'Please sign out before doing that.');
            return $response->withRedirect($this->router->pathFor('home'));
        }  else {
            $this->checkRememberMe();
        }         
        
        $response = $next($request,$response);
        return $response;
    }
    protected function checkRememberMe()
    {
        if (isset($_COOKIE['user_r']))
        {
            $data = $_COOKIE['user_r'];
            $credentials = explode('___', $data);
            
            if (empty(trim($data)) || count($credentials) !==2) {
                return $response->withRedirect($this->router->pathFor('home'));
            } else {
                $identifier = $credentials[0];
                $token = $credentials[1];
                $hashedToken =  hash('sha256', $token);
                
                $user = $this->user->where('remember_identifier', $identifier)->first();

                if ($user) {
                    if (hash_equals($hashedToken,$user->remember_token)) {
                        $this->auth->clientAttempt($user->email);
                    } else
                    {
                        $user->removeRememberCredentials();
                    }
                }



            }
        }
    }



}