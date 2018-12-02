<?php

namespace App\Http\Controllers\WeChat;

use App\Services\WechatServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * 跟微信通信
 * Class ApiController
 *
 * @package App\Http\Controllers\Wechat
 */
class ApiController extends Controller
{
    //微信后台接口配置 url 填写地址指向该方法地址
    //调用WechatServices ，这个类中构造方法进行同行验证
    public function handler(WechatServices $wechatServices){
        //echo 111;
    }
}
