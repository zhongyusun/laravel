<?php
namespace App\Services;

use App\Models\Keyword;
use App\Models\Rule;
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

    //加载规则试图文件
    public function ruleView($rule_id = 0){
        //dd($rule_id);
        //根据规则id去找规则表照旧数据
        $rule=Rule::find($rule_id);
        //dd($rule);
        //获取当前规则的所有的关键词
        //下面这句话是获取 key 这一列数据
        //dd($rule->keyword()->select('key')->get()->toArray());
        //dd($rule->keyword->toArray());
        $ruleData=[
            'name'=>$rule?$rule['name']:'',
            'keywords'=>$rule?$rule->keyword()->select('key')->get()->toArray():[]
        ];
        //dd($ruleData);
        return view('wechat.layouts.rule',compact('ruleData'));
    }

    //添加数据
    public function ruleStore($type){
        //打印所有的数据
        //dd(request()->all());
        $post=request()->all();
        //dd(request()->rule);
        //dd(request()->input('rule'));
        //将 post 提交过来的 rule 数据转为数组形式
        $rule=json_decode($post['rule'],true);
        //dd($rule);
        //另一种验证
        \Validator::make($rule,[
            'name'=>'required'
        ],[
            'name.required'=>'规则名字不能为空'
        ])->validate();
        //执行规则表的添加
        $ruleModel=Rule::create(['name'=>$rule['name'],'type'=>$type]);
        //dd($ruleModel);
        //关键词表添加
        foreach ($rule['keywords'] as $value){
            Keyword::create([
                'rule_id'=>$ruleModel['id'],
                'key'=>$value['key']
            ]);
        }
        //dd($ruleModel);
        //最后把规则对象返回
        return $ruleModel;
    }

    //编辑数据
    public function ruleUpdate($rule_id){
        //执行规则表的更新
        //dd($rule_id);
        //旧数据
        $rule=Rule::find($rule_id);
        //dd($rule);
        //新数据
        $post = request()->all();
        //dd($post);
        //将josn转为数组
        $ruleData=json_decode($post['rule'],true);
        //dd($ruleData);
        $rule->update(['name'=>$ruleData['name']]);
        //关键词编辑
            //原来的关键词删除
            $rule->keyword()->delete();
            foreach ($ruleData['keywords'] as $value){
                Keyword::create([
                    'rule_id'=>$rule_id,
                    'key'=>$value['key']
                ]);
            }

    }

}