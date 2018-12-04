@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">

        <!-- Header -->
        <div class="header mt-md-2">
            <div class="header-body">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Title -->
                        <h2 class="header-title">
                            微信基本回复
                        </h2>

                    </div>

                </div> <!-- / .row -->
                <div class="row align-items-center">
                    <div class="col">

                        <!-- Nav -->
                        <ul class="nav nav-tabs nav-overflow header-tabs">
                            <li class="nav-item">
                                <a href="{{route('wechatresponse_text.index')}}" class="nav-link ">
                                    回复列表
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('wechatresponse_text.edit',$responseText)}}" class="nav-link active">
                                    编辑回复
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{route('wechatresponse_text.update',$responseText)}}" method="post">
            @csrf  @method('PUT')
            {{--当文件中有标签时，不实例化标签--}}
            {!! $ruleView !!}
            <div id="keyword" class="card">
                <div id="keyword-textarea" class="card-body">
                    <div class="form-group" v-for="(v,k) in contents">
                        <label for="exampleInputEmail1">回复内容</label>
                        <a href="" @click.prevent="del(k)" class="text-muted">删除</a>
                        <a href="javascript:;">表情</a>
                        <textarea class="form-control" v-model="v.content"></textarea></div>
                </div>
                <div class="card-footer">
                    <button type="button" @click="add" class="btn btn-white">添加回复内容</button>
                </div>
                <textarea hidden="hidden" name="data" cols="30" rows="10">@{{ contents }}</textarea></div>
            <button class="btn btn-primary">保存数据</button>
        </form>
    </div>
@endsection
@push('js')
    <script>
        require(['vue','hdjs'],function (Vue,hdjs) {
            new Vue({
                el:'#keyword',
                data:{
                    contents:{!! $responseText['content'] !!},
                    // contents:[
                    //     {content: ''}
                    // ]
                },
                mounted(){
                    this.emotion();
                },
                updated(){
                    this.emotion();
                },
                methods:{
                    emotion(){
                        //定义this，在回调体中使用
                        var _this=this;
                        $('#keyword textarea').each(function () {
                            //表情接触点
                            //在hdjs中扩展组件表情选择出
                            hdjs.emotion({
                                //点击元素，可以为任何元素触发
                                btn: $(this).prev('a'),
                                //选中图标后填入的文本框
                                input:$(this),
                                //选择图标后执行的回调函数
                                callback:function (con,btn,input) {
                                    //sconsole.log('选择表情后的执行的回调函数');
                                    //获得 textarea 序号
                                    let index=$(input).index('#keyword-textarea textarea');
                                    //console.log(index);
                                    //这里注意 this 指向问题
                                    // _this.contents[index].content = con;
                                    //将 textarea 数据放置到 vue 中
                                    //_this 在当前方法最前面定义
                                    _this.contents[index].content=input.val();
                                }
                            })
                        })
                    },
                    add(){
                        this.contents.push({content: ''})
                    },
                    del(k){
                        this.contents.splice(k,1);
                    }
                },
            })
        })
    </script>

@endpush

