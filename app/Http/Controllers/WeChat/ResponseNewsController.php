<?php

namespace App\Http\Controllers\WeChat;

use App\Models\ResponseNews;
use App\Models\ResponseText;
use App\Services\WechatServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResponseNewsController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin.auth',[
            'except'=>[],
        ]);
    }

    public function index()
    {
        //获取旧数据
        $field=ResponseNews::all();
        //dd($field);
        return view('wechat.response_news.index',compact('field'));
    }


    public function create(WechatServices $wechatServices)
    {
        //调用WechatServices模型中的一个方法
        $ruleView=$wechatServices->ruleView();
        return view('wechat.response_news.create',compact('ruleView'));
    }


    public function store(Request $request,WechatServices $wechatServices)
    {
        //开启事务
        DB::beginTransaction();
        $rule = $wechatServices->ruleStore('news');
        //添加回复内容
        ResponseNews::create([
            'data'=>$request['data'],
            'rule_id'=>$rule['id']
        ]);
        //事务提交
        DB::commit();
        return redirect()->route('wechatresponse_news.index')->with('success','操作成功');
    }



    public function edit(ResponseNews $responseNews,WechatServices $wechatServices)
    {
         $ruleView=$wechatServices->ruleView($responseNews['rule_id']);
         return view('wechat.response_news.deit',compact('ruleView','responseNews'));
    }


    public function update(Request $request, ResponseNews $responseNews,WechatServices $wechatServices)
    {
        //在数据库入门
        //当有一个数据写不进数据库就不会写进数据库，防止数据错乱
        //开启事务
        DB::beginTransaction();
        $rule=$wechatServices->ruleStore();
        //dd($rule);
        //dd($responseText);
        //更新规则表和关键词表
        $wechatServices->ruleUpdate($responseNews['rule_id']);
        //更新回复内容
        $responseNews->update([
            'conzent'=>$request['data'],
            'rule_id'=>$rule['id']
        ]);
        //事务提交
        DB::commit();
        return redirect()->route('wechatresponse_news.index')->with('success','操作成功');
    }


    public function destroy(ResponseNews $responseNews)
    {
        //dd($responseText);
        //执行删除

        $responseNews->rule()->delete();

        return redirect()->route('wechatresponse_news.index')->with('success','操作成功');
    }
}
