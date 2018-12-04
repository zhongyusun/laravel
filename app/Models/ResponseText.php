<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponseText extends Model
{
    protected $fillable=['content','rule_id'];

    //关联 rules 表  回复语句对名字 方向多对一
    public function rule(){
        return $this->belongsTo(Rule::class);
    }

//    public function
}
