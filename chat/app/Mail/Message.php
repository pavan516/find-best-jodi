<?php

namespace App\Mail;

use App\Mail\Mailer;

class Message
{
    protected $mailer;

    public function __construct(\PHPMailer $mailer)
    {
        $this->mailer = $mailer;
       
    }

    public function to($address, $name)
    {
        $this->mailer->addAddress($address, $name);
    }

    public function subject($subject)
    {
        $this->mailer->Subject = $subject;
    }

    public function body($body)
    {   
        $this->mailer->Body = $body;
    }

}