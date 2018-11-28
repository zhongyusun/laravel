<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Laravel\Scout\Searchable;

class Article extends Model
{
    //全站动态
    //引入 trait 类
    use LogsActivity,Searchable;
    //允许向数据库中写入的字段
    protected $fillable = ['title', 'content','id'];

    //设置记录动态的属性
    protected static $logAttributes = ['created', 'updated'];
    //如果需要记录所有$fillable设置的填充属性，可以使用
    protected static $logFillable = true;

    //自定义日志名称
    protected static $logName = 'article';


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



    //定义收藏的多态关联
    public function collect(){
        //第一个参数关联模型,第二个参数跟数据迁移  collect_id  collect_type
        return $this->morphMany(Collect::class,'collect');
    }

    //定义点赞的多态关联
    public function like(){
        return $this->morphMany(Like::class,'like');
    }

    //评论通知 已读后的跳转链接
    public function getLink($param){
        return route('home.article.show',$this).$param;
    }
}
