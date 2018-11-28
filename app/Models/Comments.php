<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Comments extends Model
{
    //引入 trait 类 全站动态
    use LogsActivity;

    //允许向数据库中写入的字段
    protected $fillable = ['content', 'article_id'];

    //设置记录动态的属性
    protected static $logAttributes = ['created'];
    //如果需要记录所有$fillable设置的填充属性，可以使用
    protected static $logFillable = true;

    //自定义日志名称
    protected static $logName = 'comment';
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
