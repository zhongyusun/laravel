<?php

namespace App\Http\Controllers\Home;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            //除了里面的都可以访问'only'
            //只能访问
            'except'=>['index','show']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //测试关联模型
        //$articles=Artcle::find(2);
        //dd($articles);
        //dd($articles->toArray());
        //dd($articles->user);
        //dd($articles->user->name);
        //找到和当前文章在同一分组的所有文章
        //dd($articles->category->article);
        //dd($articles->category->article->toArray);
        //测试策略
        $data=Article::find(10);

//        dd($data->user);
        //按照日期较晚来排序，分页，一页十个
        $articles=Article::latest()->paginate(10);
        //dd($articles->toArray());
        return view('home.article.index',compact('articles','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //获取所有栏目的数据
        //在CategorySeeder里面定义，，当执行回滚时，自动执行
        $categories=Category::all();
        //dd($categories->toArray());
        //将数据分配到页面compact('categories')
        return view('home.article.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,\App\Models\Article $article)
    {
        //获取当前用户的id
        //dd(auth()->id());
        $article->title=$request->title;
        $article->category_id=$request->category_id;
        $article->content=$request->content;
        $article->user_id=auth()->id();
        //dd($artcle);
        $article->save();
        return redirect()->route('home.artcle.index')->with('success','文章发布成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('home.article.show',compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $this->authorize('update',$article);
//        dump($artcle->toArray());
        //获取所有栏目数据
        $categories = Category::all();
        //dd($categories->toArray());
        return view('home.article.edit',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->content = $request->content;
        // 防止作者被更改
        //$article->user_id = auth()->id();
        $article->save();
        return redirect()->route('home.artcle.index')->with('success','文章编辑成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('home.article.index')->with('success','文章删除成功');
    }
}
