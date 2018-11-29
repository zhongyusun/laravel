<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{
    public function index(){
        //获取所有的动态
        //$activities = Activity::all();
        $articles = Activity::latest()->paginate(5);
        //dd(111);
        //dd($activities);
        //foreach ($activities as $activity){
            //dump($activities);
        //}
        return view('home.home',compact('articles'));
    }

    //搜索
    public function search(Request $request){
        //接受搜所的关键词
        $wd=$request->query('wd');

        ////考虑有分类筛选
        /// //$category = $request->query('category');
        ////dd($wd);
        //$articles = Article::search($wd);
        //if($category){
        //	$articles = $articles->where('category_id',$category);
        //}
        //$articles  = $articles->paginate(1);
        //$categories = Category::all();


        //不考率分类筛选
        $articles=Article::search($wd)->paginate(10);

        //return view('home.search',compact('articles','categories'));
        return view('home.search.search',compact('articles'));
    }
}
