@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid" id="app">
        <!-- Header -->
        <div class="header mt-md-2">
            <div class="header-body">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Title -->
                        <h2 class="header-title">
                            微信菜单管理
                        </h2>
                    </div>
                </div> <!-- / .row -->
                <div class="row align-items-center">
                    <div class="col">

                        <!-- Nav -->
                        <ul class="nav nav-tabs nav-overflow header-tabs">
                            <li class="nav-item">
                                <a href="{{route('wechatbutton.index')}}" class="nav-link ">
                                    菜单列表
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('wechatbutton.create')}}" class="nav-link active">
                                    添加菜单
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="mobile">
                            <div class="mobile-container">
                                <dl v-for="(v,k) in menus.button">
                                    {{--一级菜单 start--}}
                                    <dt @click="editCurrentMenu(v)" >
                                        {{--stop 阻止事件冒泡--}}
                                        <span @click.stop="delTopMenu(k)" class="fa fa-minus-square"></span>
                                        @{{ v.name }}
                                    </dt>
                                    {{--一级菜单 end--}}
                                    {{--二级菜单 start--}}
                                    <dd v-for="(m,n) in v.sub_button" @click="editCurrentMenu(m)">
                                        <span @click="delSubMenu(v,n)" class="fa fa-minus-square"></span>
                                        @{{ m.name }}
                                    </dd>
                                    {{--二级菜单 end--}}
                                    <dd @click="addSubMenu(v)" v-if="v.sub_button.length<5">
                                        <span class="fa fa-plus-square"></span>
                                    </dd>
                                </dl>
                                <dl v-if="menus.button.length < 3">
                                    <dt @click="addTopMenu">
                                        <span class="fa fa-plus-square"></span>
                                    </dt>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="container-fluid">
                            <!-- Header -->
                            <div class="header mt--3">
                                <div class="header-body">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <!-- Title -->
                                            <h2 class="header-title">
                                                栏目管理
                                            </h2>

                                        </div>

                                    </div> <!-- / .row -->
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-12">

                                    <form method="post" action="{{route('wechatbutton.store')}}">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">菜单标题</label>
                                                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">

                                            @csrf

                                            <div class="card-body">


                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">菜单名称</label>
                                                    <input type="text" v-model="currentMenu.name" class="form-control" id="exampleInputEmail1" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">属性</label>
                                                    <div class="form-check form-check-inline" >
                                                        <input class="form-check-input" v-model="currentMenu.type" value="view"  type="radio">
                                                        <label class="form-check-label" for="inlineRadio1">链接</label>
                                                    </div>
                                                    <div class="form-check form-check-inline" >
                                                        <input class="form-check-input" type="radio" v-model="currentMenu.type" value="click" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                        <label class="form-check-label" for="inlineRadio2">关键词</label>
                                                    </div>
                                                </div>
                                                <div class="form-group" v-if="currentMenu.type == 'view'">
                                                    <label for="exampleInputEmail1">链接</label>
                                                    <input type="text" v-model="currentMenu.url" class="form-control" id="exampleInputEmail1" placeholder="">
                                                </div>
                                                <div class="form-group" v-if="currentMenu.type == 'click'">
                                                    <label for="exampleInputEmail1">关键词</label>
                                                    <input type="text" v-model="currentMenu.key" class="form-control" id="exampleInputEmail1" placeholder="">
                                                </div>
                                                <button type="submit" class="btn btn-primary">保存</button>
                                                <textarea name="data" hidden id="" cols="30" rows="10">@{{ menus }}</textarea>

                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--@{{ currentMenu }}--}}
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{asset('org/css/button.css')}}">
    <style>
        .border{
            border-color: red!important;
        }
    </style>
@endpush
@push('js')
    <script>
        require(['hdjs','vue'],function (hdjs,Vue) {
            new Vue({
                el:'#app',
                data:{
                    //当前编辑的菜单
                    currentMenu:{},
                    //全部菜单数据
                    menus:{
                        "button":[]
                    }
                },
                methods:{
                    //添加以及菜单
                    addTopMenu(){
                        if (this.menus.button.length<3){
                            var html={type:'click',name:'请输入标题',key:'',sub_button:[]}
                            this.menus.button.push(html);
                            this.crrentMenu=html;
                        }
                    },
                    //删除一级菜单
                    delTopMenu(k){
                        this.menus.button.splice(k,1);
                    },
                    //添加二级菜单
                    addSubMenu(v){
                          if (v.sub_button.length<5){
                              var html = {type: 'click', name: '请输入标题', key: ''}
                              v.sub_button.push(html);
                              this.currentMenu = html;
                          }
                    },
                    //v 指的是一级  n 二级下标
                    delSubMenu(v,n){
                        v.sub_button.splice(n,1);
                    },
                    //编辑当前菜单
                    editCurrentMenu(v){
                        this.currentMenu = v;
                    }
                }
            })
        })
    </script>
@endpush