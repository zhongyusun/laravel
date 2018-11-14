<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //加载登录模板
    public function register(){

    }
    //处理登录数据
    public function registerpost(){

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
        //提示并且跳转
        return redirect()->route('login')->with('success','注册成功');
    }
}
