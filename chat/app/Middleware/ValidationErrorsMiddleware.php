<?php



namespace App\Middleware;


use Slim\Views\Twig;

class ValidationErrorsMiddleware extends Middleware
{
    protected $view;
    public function __construct(Twig $view)
    {
        $this->view = $view;
    }
    public function __invoke($request, $response,$next)
    {
        if (!empty($_SESSION['errors'])) {

            $this->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);

            unset($_SESSION['errors']);
        }
        $response = $next($request,$response);
        return $response;
    }



}