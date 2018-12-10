<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//需要先配置好jwt才可以验证
class AuthController extends CommonController
{

    public function __construct()
    {
        // 除login外都需要验证
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    //登录
    public function login(){
        //dd(\request()->only(['email','password']));
        //dd(auth('api')->attempt(request()->only(['email', 'password'])));
        if (!$token = auth('api')->attempt(request()->only(['email', 'password']))) {
            //登录失败
            // ⼀个未认证错误，第⼀个参数可以传递⾃定义消息。
            return $this->response->errorUnauthorized('账号密码错误');
        }
        //dd($token);
        //登录成功
        //dd(1);
        return $this->respondWithToken($token);
    }

    //响应token
    protected function respondWithToken($token){
        //获取 jwt.php 配置文件中 token 有效期 60
        //dd(auth('api')->factory()->getTTL());
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    //获取⽤户资料
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    //注销登录
    public function logout(){
        auth('api')->logout();
        return response()->json(['message' => '退出成功']);
    }
}
