<?php

namespace App\Mail;

use Slim\Views\Twig;
use App\Mail\Message;
use App\Interfaces\MailerInterface;

use Psr\Http\Message\ResponseInterface as Response;


class Mailer
{
    protected $mailer;
    protected $view;

    public function __construct(Twig $view, \PHPMailer $mailer)  
    {
        $this->view = $view;
        $this->mailer = $mailer;
             
    }
    public function send($template, $data, $callback )
    {

        $message = new Message($this->mailer);
        $this->view->offsetSet('data', $data);
        $message->body($this->view->fetch($template));

        call_user_func($callback, $message);

        return $this->mailer->send();
        

    }
}