<?php


require __DIR__ . '/../vendor/autoload.php';

use Noodlehaus\Config;


$config = new Config(__DIR__ . '/../config/' . file_get_contents(__DIR__ . '/../mode.php') . '.php');


if ($config->get('app.show_error_detail')) {
    error_reporting(E_ALL); 
    ini_set('display_errors ', 'on');
} else
{
    error_reporting(0);
    ini_set('display_errors ', 'off');
}

if ($config->get('name') == "maintenance") {

    header("location: /maintenance.php");
    die();
}


ini_set('allow_url_fopen', 'off');
ini_set('allow_url_include', 'off');
ini_set('expose_php', 'off');
ini_set('log_errors', 'on');
// ini_set('session.name', 'myPHPnotes');
ini_set('session.cookie_secure', 0);
ini_set('session.cookie_httponly', 1);

session_start();

use App\App;

use Slim\Views\Twig;
use Respect\Validation\Validator as v;
use App\Middleware\ValidationErrorsMiddleware;
use App\Middleware\OldInputMiddleware;
use App\Middleware\CsrfViewMiddleware;
use App\Middleware\Middleware;

use Slim\Csrf\Guard;



require __DIR__ . '/../app/app.php';


$app = new App;
$container = $app->getContainer();



date_default_timezone_set("Asia/Kolkata");


$app->add(new ValidationErrorsMiddleware($container->get(Twig::class)));
$app->add(new OldInputMiddleware($container->get(Twig::class)));
$app->add(new CsrfViewMiddleware($container->get(Twig::class),$container->get(GuardInterface::class)));
// $app->add($container->get(GuardInterface::class));


// //Backslashes to escape backslashes
v::with('App\\Validation\\Rules\\');

require __DIR__ . '/../routes/main.php';




