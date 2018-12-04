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
                            图文回复
                        </h2>

                    </div>

                </div> <!-- / .row -->
                <div class="row align-items-center">
                    <div class="col">

                        <!-- Nav -->
                        <ul class="nav nav-tabs nav-overflow header-tabs">
                            <li class="nav-item">
                                <a href="{{route('wechatresponse_news.index')}}" class="nav-link ">
                                    回复列表
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('wechatresponse_news.create')}}" class="nav-link active">
                                    添加回复
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{route('wechatresponse_news.update',$responseNews)}}" method="post">
            @csrf @method('PUT')

            {!! $ruleView !!}

            <div id="app" class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="news">
                                <img :src="news.picurl" alt="">
                                <p>@{{ news.title }}</p>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <label for="exampleInputEmail1">图文标题</label>
                                <input type="text" v-model="news.title" id="exampleInputEmail1" placeholder="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">图文描述</label>
                                <textarea class="form-control" v-model="news.discription"></textarea>
                            </div>
                            <label for="exampleInputEmail1">图片</label>
                            <div class="input-group mb-3">
                                <div class="input-group mb-1">
                                    <input readonly="readonly" v-model="news.picurl" value="" class="form-control  ">
                                    <div class="input-group-append">
                                        <button type="button" @click="upImagePc" class="btn btn-secondary">单图上传</button>
                                    </div>
                                </div>
                                <div style="display: inline-block; position: relative;">
                                    <img :src="news.picurl" width="150" class="img-responsive img-thumbnail">
                                    <em title="删除这张图片" onclick="removeImg(this)" class="close" style="position: absolute; top: 3px; right: 8px;">×</em>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">跳转 url</label>
                                <input type="text" v-model="news.url" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <textarea  hidden name="data" id="" cols="30" rows="10">@{{ news }}</textarea>
            </div>
            <button class="btn btn-primary">保存数据</button>
        </form>

    </div>
@endsection
@push('css')
    <style>
        .news {
            border: 1px solid #cccccc;

        }

        .news img {
            width: 100%;
        }

        .news p {
            background: #333;
            color: #fff;
            margin: 0;
        }
    </style>
@endpush
@push('js')
    <script>
        require(['vue','hdjs'],function (Vue,hdjs) {
            new Vue({
                el:'#app',
                data:{
                    news:{!! $responseNews['data'] !!}

                },
                methods:{
                    //在hdjs中上传处理，中图片处理
                    upImagePc(){
                        hdjs.image((images)=>{
                            //上传成功的图片，数组类型
                            this.news.picurl=images[0]
                        })
                    }
                },

            })
        })
    </script>
@endpush    

