<?php

namespace App;

use App\Models\Attachment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','icon'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getIconAttribute($key){
        return $key?:asset('org/assets/img/covers/2.jfif');
    }

    //关联附件
    public function attachment(){
        return $this->hasMany(Attachment::class);
    }

    //获取指定用户粉丝
    public function fans(){
        return $this->belongsToMany(User::class,'follows','user_id','following_id');
    }

    //获取关注者
    public function following(){
        return $this->belongsToMany(User::class,'follows','following_id','user_id');
    }
}
