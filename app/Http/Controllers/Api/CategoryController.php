<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends CommonController
{

    public function categories(){
        //获取所有的栏目数据
        return $this->response->array(Category::all());
    }
}
