<?php

namespace App\Http\Controllers\Api;

use App\Models\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlashController extends CommonController
{
    public function flashs(){
        //获取所有轮播图数据
        //return $this->response->array(Flash::all());
        $limit = request()->query('limit',10);
        //dd($limit);

        return $this->response->array(Flash::limit($limit)->get());

    }
}
