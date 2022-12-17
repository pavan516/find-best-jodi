<?php


//Models

use App\Models\User;



// OAuth
use App\OAuth\GoogleAuth;
use App\OAuth\FacebookAuth;
use App\OAuth\TwitterAuth;


// OAuth Dependencies
// use Google_Client;
use Abraham\TwitterOAuth\TwitterOAuth;


use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Slim\Flash\Messages;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Interop\Container\ContainerInterface;
use App\Support\Contracts\StorageInterface;

use App\Support\Storage\SessionStorage;

use App\Interfaces\FlashInterface;


use App\Helpers\Flash;
use App\Helpers\Php;
use App\Helpers\HandleError;
use App\Helpers\Log;




use App\Validation\Validator;
use App\Validation\Contracts\ValidatorInterface;

use Noodlehaus\Config;

use Slim\Csrf\Guard;

use App\Mail\Mailer;

use DI\ContainerBuilder;
use DI\Bridge\Slim\App as DIBridge;



use App\Mail\Mailer as Mail;


use Monolog\Logger;
use Monolog\Handler\StreamHandler;



use function DI\get;

return [
    
    'router' => get(Slim\Router::class),
    StorageInterface::class => function (ContainerInterface $container) {
        return new SessionStorage;
    },
   
    Twig::class => function (ContainerInterface $container) {
        $view = new Twig(__DIR__ . '/../views',[
            'cache' => false
        ]);

        $view->addExtension(new TwigExtension(
            $container->get('router'),
            $container->get('request')->getUri()

        ));
        
        
        $view->getEnvironment()->addGlobal('flash',$container->get('flash'));
        $view->getEnvironment()->addGlobal('php',$container->get(Php::class));
        $view->getEnvironment()->addGlobal('config',$container->get(Config::class));

        
        return $view;
    },
    'view' => \DI\get(Twig::class),

    Config::class => function(ContainerInterface $container) {
        return new Config(__DIR__ . '/../config/' . file_get_contents(__DIR__ . '/../mode.php') . '.php');
    },
    'config' => \DI\get(Config::class),

    User::class => function(ContainerInterface $container) {   
        return new User();
    },
    'user' => \DI\get(User::class),

    Auth::class => function(ContainerInterface $container) {   
        return new Auth($container->get(User::class));
    },
    'auth' => \DI\get(Auth::class),

    
   
   
    
    
    
    
    FlashInterface::class => function () {
        return new Flash();
    },

    'flash' => \DI\get(FlashInterface::class),
    ValidatorInterface::class => function (ContainerInterface $container) {
        return new Validator();
    },

   
    Query::class => function ( ContainerInterface $container) {
        return new Query( $container->get(Mailer::class),$container->get(Auth::class));
    },
    
    GuardInterface::class => function (ContainerInterface $container) {
        $guard = new Guard;
        $guard->setFailureCallable(function ($request, $response, $next) use ($container) {
                return $container->get(HandleError::class)->csrf($request, $response);
        });
        return $guard;
    },
    Mailer::class => function (ContainerInterface $container) {
        $mailer= new PHPMailer;
        $mailer->isSMTP();
        $mailer->Host = $container->get(Config::class)->get('mail.host');
        $mailer->SMTPAuth = $container->get(Config::class)->get('mail.smtp_auth');
        $mailer->SMTPSecure = $container->get(Config::class)->get('mail.smtp_secure');
        $mailer->Port = $container->get(Config::class)->get('mail.port');
        $mailer->Username = $container->get(Config::class)->get('mail.username');
        $mailer->Password = $container->get(Config::class)->get('mail.password');
        $mailer->msgHTML(true);
        $mailer->CharSet = 'UTF-8';
        
        $mailer->From = $container->get(Config::class)->get('mail.username');
        $mailer->FromName = $container->get(Config::class)->get('app.name');

        return new Mailer($container->get(Twig::class), $mailer);   

    },
    'mail' => \DI\get(Mail::class),
    
   
    Php::class => function (ContainerInterface $container) {
        return new Php();
    },
    
                     
    'settings.displayErrorDetails' =>  function (ContainerInterface $container) {        
        return  $container->get(Config::class)->get('app.show_error_detail');
    },

    'notFoundHandler' =>  function (ContainerInterface $container) {        
       
            return function ($request, $response) use ($container) {
             
                return $container->get(HandleError::class)->notFound($request, $response);
                
        };
       
    },
    'notAllowedHandler' =>  function (ContainerInterface $container) {        
       
            return function ($request, $response) use ($container) {
             
                return $container->get(HandleError::class)->notAllowed($request, $response);
                
        };
       
    },
    'errorHandler' =>  function (ContainerInterface $container) {        
       
            return function ($request, $response, $error) use ($container) {
                
                return $container->get(HandleError::class)->error($request, $response,$error);
        };
       
    },
    'phpErrorHandler' =>  function (ContainerInterface $container) {  

            return function ($request, $response, $error) use ($container) {
             
                return $container->get(HandleError::class)->phpError($request, $response,$error);
        };
       
    },
    Logger::class => function (ContainerInterface $container) {
        $logger = new Monolog\Logger('logger');
        $logger->pushProcessor(new \Monolog\Processor\WebProcessor);
        return $logger;
    },  
    Log::class => function (ContainerInterface $container) {
        return new Log($container->get(Logger::class));
    },  
    'log' => \DI\get(Log::class),
    HandleError::class => function (ContainerInterface $container) {
            return new HandleError($container->get(Twig::class),$container->get(Log::class),$container->get(Mailer::class), $container->get(Config::class));
        },  
    'error' => \DI\get(HandleError::class),
    // OAuth
    GoogleAuth::class => function (ContainerInterface $container) {
        
        return new GoogleAuth(new Google_Client, 
                             $container->get(Config::class)->get('google.client') ,
                             $container->get(Config::class)->get('google.secret'), 
                             $container->get(Config::class)->get('google.redirect_uri'),
                             $container->get(Config::class)->get('google.scopes'));
    },  
    FacebookAuth::class => function (ContainerInterface $container) {
        return new FacebookAuth($container->get(Config::class)->get('facebook.app_id') ,
                                 $container->get(Config::class)->get('facebook.app_secret'), 
                                 $container->get(Config::class)->get('facebook.default_graph_version'),                                 
                                 $container->get(Config::class)->get('facebook.redirect_uri'), 
                                 $container->get(Config::class)->get('facebook.scopes'));
    },  
    TwitterAuth::class => function (ContainerInterface $container) {
      
        return new TwitterAuth(
                            $container->get(Config::class)->get('twitter.consumer_key') ,
                            $container->get(Config::class)->get('twitter.consumer_secret'), 
                            $container->get(Config::class)->get('twitter.redirect_uri'));
    },  
     YouTube::class => function (ContainerInterface $container) {
        
        return new YouTube(new Google_Client, $container->get(Config::class));
    }, 
    
    
];


