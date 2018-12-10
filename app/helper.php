<?php
//助手函数
if (!function_exists('hd_config')){
    //帮助读取后台数据项数据
    function hd_config($var){
        //dd($var);
        static $cache=[];
        //将字符串拆分为数组
        $info=explode('.',$var);
        if ($info){
            //清空所有缓存
            //Cache::flush();
            //获取缓存中config_cache数据,如果数据不存在,那么会以第二个参数作为默认值
            $cache=Cache::get('config_cache',function (){
                //pluck 手册地址:查询构造器
                //pluck('data','value') 获取两列数据,data 作为键名  ,value 键值
                return \App\Models\Config::pluck('data','name');
            });
            //isset($cache[$info[0]][$info[1]])?$cache[$info[0]][$info[1]]:''
            return $cache[$info[0]][$info[1]]??'';
        }
    }
}


//检测当前用户是否有权限
function hdHasRole($role){
    if (!auth()->user()->hasRole($role)){
        throw new \App\Exceptions\AuthException('暂无权限');
    }
}