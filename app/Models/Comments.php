<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
/**
 * 这个属性应该被转换为原生属性
 *
 * @var array
 */
    protected $casts=[
      'created_at'=>'datetime:Y-m-d',
    ];
    //关联用户
    public function user(){
        return $this->belongsTo(User::class);
    }

    //评论关联通知
    public function article(){
        return $this->belongsTo(Article::class);
    }

    //点赞关联
    public function like(){
        //第一个参数关联模型,第二个参数跟数据迁移  like_id  like_type
        return $this->morphMany(Like::class,'like');
    }
}
