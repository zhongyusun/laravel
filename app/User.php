<?php

namespace App;

use App\Models\Article;
use App\Models\Attachment;
use App\Models\Collect;
use App\Models\Like;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Contracts\Providers\JWT;

class User extends Authenticatable implements JWTSubject
{
    use HasRoles;
    use Notifiable;

//　1. 在类的声明中，通过关键字extends来创建一个类的子类。一个类通过关键字implements声明自己使用一个或者多个接口。
//
//extends 是继承某个类, 继承之后可以使用父类的方法, 也可以重写父类的方法; implements 是实现多个接口, 接口的方法一般为空的, 必须重写才能使用。
//
//　　2.extends 是继承父类，只要那个类不是声明为final或者那个类定义为abstract的就能继承，JAVA中不支持多重继承，但是可以用接口 来实现，这样就要用到implements，继承只能继承一个类，但implements可以实现多个接口，用逗号分开就行了
//
//　　3. extends， 可以实现父类，也可以调用父类初始化 this.parent()。而且会覆盖父类定义的变量或者函数。这样的好处是：架构师定义好接口，让工程师实现就可以了。整个项目开发效率和开发成本大大降低。而  implements，实现父类，子类不可以覆盖父类的方法或者变量。即使子类定义与父类相同的变量或者函数，也会被父类取代掉。
//
//　　总结：这两种实现的具体使用，是要看项目的实际情况，需要实现，不可以修改implements，只定义接口需要具体实现，或者可以被修改扩展性好，用extends。
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

    //重写 数据库通知中 获取所有通知的 notifications 方法
    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class,'notifiable')->orderBy('read_at','asc')->orderBy('created_at','desc');
    }

    //给用户设置默认头像
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

    //关联 收藏 模型
    public function collect(){
        return $this->hasMany(Collect::class);
    }

    //用户关联like
    public function like(){
        return $this->hasMany(Like::class);
    }

    /**
     * 获取将存储在JWT主题声明中的标识符.
     * 就是⽤户表主键 id
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * 返回⼀个键值数组，其中包含要添加到JWT的任何⾃定义声明.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
