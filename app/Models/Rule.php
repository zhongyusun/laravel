<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable=['name'];


    //关联 keyword  名字和关键词
    public function keyword(){
        return $this->hasMany(Keyword::class);
    }
}
