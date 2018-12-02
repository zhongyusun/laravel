<?php

namespace App\Http\Controllers\WeChat;

use App\Models\Button;
use App\Services\WechatServices;
use Houdunwang\WeChat\WeChat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ButtonController extends Controller
{

    public function index()
    {
        $buttons=Button::latest()->paginate(10);
        //加载模板文件
        return view('wechat.button.index',compact('buttons'));
    }


    public function create()
    {
        return view('wechat.button.create');
    }


    public function store(Request $request)
    {
        //dd($request->title);
        if ($request->title==''){
            return redirect()->back()->with('danger','菜单标题不能为空');
        }
        Button::create($request->all());

        return redirect()->route('wechatbutton.index')->with('success','菜单添加成功');
    }



    public function edit(Button $button)
    {
        //dd($button);
        return view('wechat.button.create',compact('button'));
    }


    public function update(Request $request, Button $button)
    {
        $button->update($request->all());
        return redirect()->route('wechatbutton.index')->with('success','菜单编辑成功');
    }


    public function destroy(Button $button)
    {
        $button->delete();
        return redirect()->route('wechatbutton.index')->with('success','菜单删除成功');
    }

    //将微信菜单推送到公众号
    //推送菜单之前 先实例化WechatService,该类构造方法有微信通信验证
    public function push(Button $button,WechatServices $wechatServices){
        //将原来数据库 json 格式数据转为数组
        $menu=json_decode($button['data'],true);
        //wechat 类要求传递惨淡数据需要时数组
		$res = WeChat::instance('button')->create($menu);
		//dd($res);
		if($res['errcode'] == 0){
            //将当前菜单数据表 status 修改1,其余的改为0
            $button->update(['status'=>1]);
            Button::where('id','!=',$button->id)->update(['status'=>0]);
            return back()->with('success','菜单推送成功');
        }else{
            return back()->with('danger',$res['errmsg']);
        }
    }
}
