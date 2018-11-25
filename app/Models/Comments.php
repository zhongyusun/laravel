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
}
