<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable=[
        'user_id'
    ];

    //关联用户
    public function user(){
        return $this->belongsTo(User::class);
    }

    //多态关联模型 article
    public function belongsModel(){
        return $this->morphTo('like');
    }


}
