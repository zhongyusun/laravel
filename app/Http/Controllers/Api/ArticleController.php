<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends CommonController
{
    public function articles(){
        //获取所有的文章数据
        //return Article::all();
        //获取一条文章数据
            //laravel语法
        //return Article::find(1);
            //结合transformer
        //return $this->response->array(Article::find(1));
        //返回错误信息
        //return response()->json(['error' => 'Unauthorized'], 401);
        //return $this->response->error('只是一个错误信息',404);
        //截取十条数据
        //$limit = \request()->query('limit',10);
        //返回所有文章数据,并且每个文章数据中包含一个栏目
        //return $this->response->array(Article::with('category')->get());
        //dingo中的Transformers
        //return $this->response->collection(Article::all(),new \App\Transformers\ArticleTransformer());
            /*********/
        //截取十条数据
        $limit = \request()->query('limit',10);
        $cid = request()->query('cid');
       // dd($cid);
        if($cid){
            $articles = Article::latest()->where('category_id',$cid)->paginate($limit);
        }else{
            $articles = Article::latest()->paginate($limit);
        }

        return $this->response->paginator($articles,new ArticleTransformer());
    }


    //获取制定一篇文章
    public function show($id){
        return $this->response->item(Article::find($id),new ArticleTransformer());
    }
}
