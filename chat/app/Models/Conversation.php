<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* Conversation
*/
class Conversation extends Eloquent
{

    protected $table = 'conversations';
    public function users()
    {
        return $this->belongsToMany(User::class,'conversation_user', 'conversation_id', 'user_id')->withPivot('user_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id', 'id');
    }

    

 
  
}