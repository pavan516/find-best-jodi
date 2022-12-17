<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* Conversation
*/
class ConversationPivot extends Eloquent
{

    protected $table = 'conversation_user';
    protected $fillable =[ 'conversation_id', 'user_id'];

    public function recipient($user_id, $conversation_id)
    {
        $coversation = $this->find($conversation_id);
    }
    

 
  
}