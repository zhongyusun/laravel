<?php

namespace App\Http\Controllers\Member;

use App\Exceptions\UploadException;
use App\Models\Article;
use App\Models\Category;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'only'=>['show','edit','update']
        ]);
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,Request $request)
    {
        //接受category参数
        //$category=$request->category;
        $category=$request->query('category');
        //dd($category);
        //获取当前作者的所有文章 每页8 个
        $articles = Article::latest()->where('user_id',$user->id);
        if ($category){
            $articles=$articles->where('category_id',$category);
        }
        $articles=$articles->paginate(8);
        $categories=Category::all();
        //dd($user);//当前登录的用户

        //dd($articles);
        return view('member.user.show',compact('user','articles','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user,Request $request)
    {
        $this->authorize('isMine',$user);
        //接受页面传来的type参数
        $type=$request->get('type');
        //dd($type);
        return view('member.user.edit_'.$type,compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('isMine',$user);
        //dd($user->name);
        //dd($request->all());
        $data=$request->all();
        //dd($data);
        //sometimes当传过来的参数里面有password时，执行更新，没有则忽略
        $this->validate($request,[
            'password' =>'sometimes|required|min:3|confirmed',
            'name'=>'sometimes|required',
            'icon'=>'sometime'
        ],[
            'password.required'=>'密码不能为空',
            'password.min'=>'密码最小长度不能低于3个字符',
            'password.confirmed'=>'前后密码不一致',
            'name.required'=>'昵称不能为空'
        ]);
        //加密密码
        if ($request->password){
            $data['password']=bcrypt($data['password']);
        }
        //执行更新
        $user->update($data);
        return back()->with('success','修改成功');
    }

    public function destroy(User $user)
    {
        //
    }

    // 关注  取消关注
    //这里user 被关注者
    public function attention(User $user){
        //dd(1);
        auth()->user()->following()->toggle($user);
        return back();
    }
}
