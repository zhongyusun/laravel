<?php

namespace App\Http\Controllers\Admin;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    //加载模板文件
    public function edit($name){

        //获取配置项数据
        //firstOrNew手册位置: Eloquent ORM-->快读入门
        $config = Config::firstOrNew(
            ['name'=>$name]
        );
        //dd($config);
        //dd($config['data']);
        return view('admin.config.edit_'.$name,compact('name','config'));
    }

    //数据的添加/更新
    public function update($name,Request $request){
        //updateOrCreate 执行更新或者添加
        //updateOrCreate手册位置: Eloquent ORM-->快读入门
        $res=Config::updateOrCreate(
          ['name'=>$name],//查询条件
            //注意:$request->all()是数组,直接写入数据表报错
            //需要借助模型属性 cates
          ['name'=>$name,'data'=>$request->all()]//更新或者添加数据
        );
        //更改env文件用的
        hd_edit_env($request->all());

        //跳转，提示成功
        return back()->with('success','更新成功');
    }
}
