<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model as Eloquent;

/**
* blockuser
*/
class BlockUser extends Eloquent
{

    protected $table = 'block_user';
    protected $fillable = [
        'blocker_id',
        'attainer_id'

    ];

    

 
  
}