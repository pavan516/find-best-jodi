<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* Follower
*/
class Follower extends Eloquent
{

    protected $table = 'follower';

    // The one who follower the current user
    public function follower()
    {
        return $this->hasOne(User::class, 'user_id', 'follow_id' );
    }

    // Current user follows him
    public function following()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id' );
    }

  
}