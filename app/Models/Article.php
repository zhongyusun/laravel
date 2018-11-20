<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //定义文章与用户的关联
    public function user(){
        //完整关联
        //return $this->belongsTo(User::class,'user_id','id');
        return $this->belongsTo(User::class);
    }
    //定义文章与文章分组的关联
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
