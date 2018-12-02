<?php
namespace App\Services;

use Houdunwang\WeChat\WeChat;

class WechatServices{
    public function __construct()
    {
        //与微信通信绑定
        //读取  config/hd_config.php配置文件
        //config()读取框架配置项，框架配置项读取env对应数据，数据来源与我们的后台
        $config=config('hd_wechat');
        //dd($config);
        WeChat::config($config);
        WeChat::valid();
    }
}