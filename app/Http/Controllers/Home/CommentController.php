<?php

namespace App\Http\Controllers\Home;

use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class  CommentController extends Controller
{
    //获取指定文章的所有评论
    public function index(Request $request,Comments $comments)
    {
        //dd(1);
        //$comments = Comment::where('article_id',$request->article_id)->get();
        //这样关联,保证 Comment 模型中有关联 user 的方法
        $comments=$comments->with(['user'])->where('article_id',$request->article_id)->get();
        //dd($comments->toArray());
        foreach ($comments as $comment){
            $comment->like_num=$comment->like->count();
        }
        //dd($comments->toArray());
        return['code'=>1,',message'=>'','comment'=>$comments];
    }
    //添加评论
    public function store(Request $request,Comments $comments)
    {
        //执行评论表添加
        $comments->user_id=auth()->id();
        $comments->article_id=$request->article_id;
        $comments->content=$request['content'];
        $comments->save();
        //dd($comments);
        //dd($comment->with('user')->get()->toArray());
        //关联 user
        $comments=$comments->with('user')->find($comments->id);
        $comments->like_num=$comments->like->count();
        //dd($comments->toArray());
        return['code'=>1,'message'=>'','comment'=>$comments];
    }
}