<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* Messages
*/
class Message extends Eloquent
{

    protected $table = 'messages_new';
    protected $fillable = ['sender_id', 'type', 'content'];
  
}