<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{

    protected $fillable=[
        'user_id'
    ];
    public function user(){
        $this->belongsTo(User::class);
    }
}
