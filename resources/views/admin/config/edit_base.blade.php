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
                            基本配置
                        </h2>

                    </div>

                </div> <!-- / .row -->
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">


                <div class="card">
                    <div class="card-body">

                        <form method="post" action="{{route('admin.config/update',['name'=>$name])}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">网站标题</label>
                                <input type="text" name="title" value="{{$config['data']['title']}}" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">网站关键词</label>
                                <input type="text" name="keyword" value="{{$config['data']['keyword']}}" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">网站描述</label>
                                <input type="text" name="description" value="{{$config['data']['description']}}" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">icp</label>
                                <input type="text" name="icp" class="form-control" value="{{$config['data']['icp']}}" id="exampleInputEmail1" placeholder="">
                            </div>

                            <button type="submit" class="btn btn-primary">保存</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush