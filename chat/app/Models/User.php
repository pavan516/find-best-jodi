<?php


namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* User Model
*/
class User extends Eloquent
{

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $gaurded = ['user_pass'];
    public function followers()
    {
        return $this->hasMany(Follower::class, 'user_id', 'user_id');
    }
    public function followings()
    {
        return $this->hasMany(Follower::class, 'follow_id', 'user_id');
    }
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_user', 'user_id')->withPivot('user_id');
    }
  
}