<?php

namespace App\Http\Controllers\WeChat;

use App\Models\ResponseText;
use App\Services\WechatServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResponseTextController extends Controller
{

    public function index()
    {
        //获取旧数据
        $filed=ResponseText::all();
        //dd($filed);
        return view('wechat.response_text.index',compact('filed'));
    }


    public function create(WechatServices $wechatServices)
    {
        //调用WechatServices模型中的一个方法
        $ruleView=$wechatServices->ruleView();
        return view('wechat.response_text.create',compact('ruleView'));
    }


    public function store(Request $request,WechatServices $wechatServices)
    {
        //在数据库入门
        //当有一个数据写不进数据库就不会写进数据库，防止数据错乱
        //开启事务
        DB::beginTransaction();
        //dd($request->all());
        //dd($request->data);
        $rule=$wechatServices->ruleStore();
        //添加回复内容
        ResponseText::create([
           'content'=>$request['data'],
           'rule_id'=>$rule['id']
        ]);
        //事务提交
        DB::commit();
        return redirect()->route('wechatresponse_text.index')->with('success','操作成功');
    }


    public function edit(ResponseText $responseText,WechatServices $wechatServices)
    {
        //dd($responseText);
        $ruleView=$wechatServices->ruleView($responseText['rule_id']);
        //dd($ruleView);
        return view('wechat.response_text.edit',compact('ruleView','responseText'));
    }

    public function update(Request $request, ResponseText $responseText,WechatServices $wechatServices)
    {
        //在数据库入门
        //当有一个数据写不进数据库就不会写进数据库，防止数据错乱
        //开启事务
        DB::beginTransaction();
        $rule=$wechatServices->ruleStore();
        //dd($rule);
        //dd($responseText);
        //更新规则表和关键词表
        $wechatServices->ruleUpdate($responseText['rule_id']);
        //更新回复内容
        $responseText->update([
            'conzent'=>$request['data'],
            'rule_id'=>$rule['id']
        ]);
        //事务提交
        DB::commit();
        return redirect()->route('wechatresponse_text.index')->with('success','操作成功');
    }


    public function destroy(ResponseText $responseText)
    {
        //dd($responseText);
        //执行删除
        $responseText->rule()->delete();
        return redirect()->route('wechatresponse_text.index')->with('success','操作成功');
    }
}
