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
       return $this->belongsTo(User::class);
    }

    //关联 多态 模型
    public function belongsModel(){
        return $this->morphTo('collect');
    }
}
