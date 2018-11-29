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
                            邮箱配置
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
                                <label for="exampleInputEmail1">驱动</label>
                                <input type="text" name="MAIL_DRIVER" value="{{$config['data']['MAIL_DRIVER']??'smtp'}}" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">主机</label>
                                <input type="text" name="MAIL_HOST" value="{{$config['data']['MAIL_HOST']??'smtp.qq.com'}}" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">端口</label>
                                <input type="text" name="MAIL_PORT" value="{{$config['data']['MAIL_PORT']??'25'}}" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">账号</label>
                                <input type="text" name="MAIL_USERNAME" class="form-control" value="{{$config['data']['MAIL_USERNAME']}}" id="exampleInputEmail1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">密码</label>
                                <input type="text" name="MAIL_PASSWORD" class="form-control" value="{{$config['data']['MAIL_PASSWORD']}}" id="exampleInputEmail1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">发信邮箱</label>
                                <input type="text" name="MAIL_FROM_ADDRESS" class="form-control" value="{{$config['data']['MAIL_FROM_ADDRESS']}}" id="exampleInputEmail1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">发信人</label>
                                <input type="text" name="MAIL_FROM_NAME" class="form-control" value="{{$config['data']['MAIL_FROM_NAME']}}" id="exampleInputEmail1" placeholder="">
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