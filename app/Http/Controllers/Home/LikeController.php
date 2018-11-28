<?php

namespace App\Http\Controllers\Home;

use App\Models\Article;
use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function __construct()
    {//auth中间件对应的中间件在哪里,需要看注册中间件(app/Http/Kernal.php中$routeMiddleware)
        //article/show.blade.php模板中点赞增加 auth 判断用户是否登录
        $this->middleware('auth',[
           'only'=>['make']
        ]);
    }

    public function make(Request $request){
        $type=$request->query('type');
        $id=$request->query('id');
        //dd($request->all());
        //根据接受的get参数来组合模型类
        //首字母大写
        $class='App\Models\\'.ucfirst($type);

        //dd($class);
        //找到当前文章的所有数据
        //$model=Article::find($id);
        $model=$class::find($id);
        //dd($model);
        //获取当前文章所有点赞的数据
        //dd($model->like->all());

        //返回 like 模型 或者 null
        //dd($model->like);
        if ($like=$model->like->where('user_id',auth()->id())->first()){
            //执行删除

            $like->delete();
        }else{
            //执行添加
            //dd(1);
            //dd($model->zan()->create());
            $model->like()->create(['user_id'=>auth()->id()]);
        }
        //dd(1);
        //判断是否为异步
        //(在写评论点赞的时候发现缺少数据，会来补充数据)
        if ($request->ajax()){
            //dd($class);
            //这个需要重新获取对应模型,这句话结合异步请求
            $newModel = $class::find($id);
            //dd($newModel);
            return ['code'=>1,'message'=>'','like_num'=>$newModel->like->count()];
        }
        return back();
    }
}
