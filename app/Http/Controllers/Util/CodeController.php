<?php

namespace App\Http\Controllers\Util;

use App\Notifications\RegisterNotify;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
    //发送验证码
    public function send(Request $request){
        //获得所有请求的数据
        //dd($request->all());
        //dd($request->username);
        //随机四位验证码
        $code=$this->random();
        //dd($code);
        //发送验证码
        $user=User::firstOrNew(['email'=>$request->username]);//user模型对象
        //dd($user);
        //dd($user->toarray());
        //需要创建通知类：
        $user->notify(new RegisterNotify($code));
        //将验证码存进session中
        session()->put('code',$code);
        //返回数据
        return ['code' => 1, 'message' => '验证码发送成功'];
    }
    //随机四位验证码
    public function random($len=4){
        $res='';
        for ($i=0;$i<$len;$i++){
            $res .=mt_rand(0,9);
        }
        return $res;
    }
}
