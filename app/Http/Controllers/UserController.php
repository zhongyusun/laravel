<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        //调用中间件，保护登录注册（已经登录用户不允许再访问登录注册）
        $this->middleware('guest',[
            'only'=>['register','registerpost','passwordreplace','passwordpost','login','loginpost']
        ]);
    }

    //加载登录模板
    public function register(){
        //dd(111);
         return view('user.register');
    }


    //处理登录数据
    public function registerpost(Request $request){
        //验证登录
        $this->validate($request,[
            'email'=>'email',
            'password'=>'required|min:3'
        ],[
            'email.email'=>'请输入邮箱',
            'password.required'=>'请输入登录密码',
            'password.min'=>'密码不得少于3位置'
        ]);
        //执行登陆，手册：用户认证/手动用户验证
        $credentials = $request->only('email', 'password');
        //dd($credentials);
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            //登录成功跳回首页
            return redirect()->route('home');
        }
        return redirect()->route('register')->with('danger','密码或用户名不正确');
    }


    //处理退出
    public function registerout(){
       // dd(111);
        Auth::logout();
        return redirect()->route('home');
    }

    //加载密码重置模板
    public function passwordreplace(){
        return view('user.passwordreplace');
    }

    //处理密码重置数据
    public function passwordpost(PasswordRequest $request){
        //根据用户提交过来的邮箱去数据库查找数据
        $user=User::where('email',$request->email)->first();
        //dd($user);
        //dd($user->password);
        if ($user){
            //更新密码
            $user->password=bcrypt($request->password);
            //保存数据
            $user->save();
            return redirect()->route('register')->with('success','修改成功');
        }

    }



    //加载注册模板
    public function login(){
        //dd(111);
        return view('user.login');
    }
    //处理注册数据
    public function loginpost(UserRequest $request){
        //dd($request->all());
        //将数据储存到数据库
        $data=$request->all();
        //加密密码，并重新写入数据库
        $data['password'] = bcrypt($data['password']);
        //x写入数据库
        User::create($data);
        //提示并且跳转    redirect重定向跳转页面    route  url
        return redirect()->route('register')->with('success','注册成功');
    }
}
