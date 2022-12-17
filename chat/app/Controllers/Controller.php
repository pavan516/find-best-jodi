<?php


namespace App\Controllers;

//Connection
use App\Database\Connection;



//Models

use App\Models\User;
use App\Models\Online;
use App\Models\Conversation;
use App\Models\ConversationPivot;
use App\Models\Follower;
use App\Models\BlockUser;
use App\Models\Message as ChatMessage;
use App\Models\Post;
use App\Models\Event;
use App\Models\News;
use App\Models\StartUp;




// OAuth
use App\OAuth\GoogleAuth;
use App\OAuth\FacebookAuth;
use App\OAuth\TwitterAuth;
use App\OAuth\YouTube;
//Mail
use App\Mail\Message;
use App\Mail\Mailer;

//Slim
use Slim\Views\Twig;
use Slim\Router;



//Helpers

use App\Helpers\HandleError;
use App\Helpers\Log;


//Add-in
use RandomLib\Factory as RandomLib;
use Faker\Factory as Faker;

//Interfaces
use App\Interfaces\FlashInterface as Flash;


//Validator
use Respect\Validation\Validator;
use App\Validation\Contracts\ValidatorInterface;

//Config
use Noodlehaus\Config;

// //Middlewares
// use App\Middleware\AuthMiddleware;
// use App\Middleware\GuestMiddleware;
// use App\Middleware\AdminMiddleware;
// use App\Middleware\EditorMiddleware;
// use App\Middleware\HighSecurityMiddleware;

//Logger
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class Controller
{

    protected $auth;
    protected $role;
    protected $user;
    protected $account;



    protected $error;    
    protected $message;
    protected $mail;
    protected $view;
    protected $router;

    protected $randomlib;
    protected $flash;

    protected $validator;
    protected $config;

    protected $google;
    protected $facebook;
    protected $twitter;
    protected $youtube;




    public function __construct(Connection $connection, Message $message, Mailer $mail,Twig $view, Router $router,                            RandomLib $randomlib,  Flash $flash,
                                 Validator $v, ValidatorInterface $validator, Config $config, Log $log, HandleError $error,
                                 User $user, GoogleAuth $google, FacebookAuth $facebook, TwitterAuth $twitter, YouTube $youtube , Conversation $conversation, ConversationPivot $conversationpivot, Follower $follower, ChatMessage $chatmessage, Online $online, BlockUser $blockuser, Event $event, News $news, StartUp $startup,   Post $post


                                 )
    { 
          $this->connection = $connection;
          

          $this->message = $message ;
          $this->mail = $mail ;
          $this->view = $view ;
          $this->router = $router ;
      
   
          $this->randomlib = $randomlib ;
          $this->flash = $flash ;
          $this->error = $error ;

          $this->validator = $validator ;
          $this->config = $config ;
          $this->log = $log ;


          $this->user = $user;
          $this->conversation = $conversation;
          $this->conversationpivot = $conversationpivot;
          $this->follower = $follower;
          $this->chatmessage = $chatmessage;
          $this->online = $online;
          $this->blockuser = $blockuser;
          $this->post = $post;
          $this->startup = $startup;
          $this->event = $event;
          $this->news = $news;

          
          $this->google = $google;
          $this->facebook = $facebook;
          $this->twitter = $twitter;
          $this->youtube = $youtube;
    }
  

}