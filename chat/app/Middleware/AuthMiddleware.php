<?php

namespace App\Middleware;
use App\Interfaces\FlashInterface as Flash;
use App\Models\Auth;
use Slim\Router;

class AuthMiddleware extends Middleware
{
    protected $auth;
    protected $flash;
    protected $router;
    public function __construct( Router $router, Flash $flash ,Auth $auth)
    {
        $this->auth = $auth;
        $this->router = $router;
        $this->flash = $flash;
    }
    public function __invoke($request, $response,$next)
    {

        //check if the user is not signed in
        if (!$this->auth->check()) {
            $destinationUrl= urlencode($request->getUri()->getPath());            
            $this->flash->addMessage('error', 'Please sign in before doing that.');
            return $response->withRedirect($this->router->pathFor('signin') . "?destination={$destinationUrl}");
        }          

        $response = $next($request,$response);
        return $response;
    }

}