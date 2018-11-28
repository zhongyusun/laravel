<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Collect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectController extends Controller
{
    //收藏，取消收藏
    public function make(Request $request){
        //接受type/id
        $type=$request->query('type');
        $id=$request->query('id');
        //根据 get 参数 type 组合模型类 class 名
        $class='App\Models\\'.ucfirst($type);
        //dd($class);
        //$model = Article::find($id);
        //$model = Comment::find($id);
        //$model 收藏
        $model=$class::find($id);
//        dd($model);
        //获得当前文章的所有收藏模型数据
        //dd($model->collect->all());
        //返回  collect 模型  或者 null
        //dd($model->collect->where('user_id',auth()->id())->first());
        if ($collect=$model->collect->where('user_id',auth()->id())->first()){
            //执行删除
            $collect->delete();
        }else{
            //执行添加
            $model->collect()->create(['user_id'=>auth()->id()]);
        }
        return back();
    }
}
