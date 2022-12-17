<?php

namespace App\Middleware;
use App\Interfaces\FlashInterface as Flash;
use App\Models\Auth;
use Slim\Router;

class RoleMiddleware extends Middleware
{
    protected $auth;
    protected $flash;
    protected $router;
    protected $accessable_roles;
    public function __construct( Router $router, Flash $flash ,Auth $auth, array $accessable_roles)
    {
        $this->auth = $auth;
        $this->router = $router;
        $this->flash = $flash;
        $this->accessable_roles = $accessable_roles;
    }
    public function __invoke($request, $response,$next)
    {
        //check if the user is not signed in
        if (!$this->auth->check()) {
            $destinationUrl= urlencode($request->getUri()->getPath());            
            $this->flash->addMessage('error', 'Please sign in before doing that.');
            return $response->withRedirect($this->router->pathFor('signin') . "?destination={$destinationUrl}");
        }          
        // check if the user have the specified role
        if ($this->auth->user()->haveAccess($this->accessable_roles)) {
            $response = $next($request,$response);
            return $response;
        }     
        $this->flash->addMessage('error', 'You do not have enough privileges to access this page.');
        return $response->withRedirect($this->router->pathFor('home'));
    }

}