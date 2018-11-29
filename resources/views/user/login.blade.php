<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/fonts/feather/feather.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/highlight/styles/vs2015.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/quill/dist/quill.core.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/flatpickr/dist/flatpickr.min.css">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/css/theme.min.css">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>注册</title>
</head>
<body class="d-flex align-items-center bg-white border-top-2 border-primary">

<!-- CONTENT
================================================== -->
<div class="container-fluid">
    <div class="row align-items-center justify-content-center">
        <div class="col-12 col-md-5 col-lg-6 col-xl-4 px-lg-6 my-5">

            <!-- Heading -->
            <h1 class="display-4 text-center mb-3">
                注册
            </h1>

            <!-- Subheading -->
            <p class="text-muted text-center mb-5">
                注册帐号参与交流与学习
            </p>

            <!-- Form -->
            <form method="post" action="{{route('loginpost')}}">
            @csrf
            <!-- Email address -->
                <div class="form-group">
                    <!-- Label -->
                    <label>
                        昵称
                    </label>
                    <!-- Input -->
                    <input type="text" class="form-control" placeholder="请输入个性昵称" name="name">
                </div>

                <div class="form-group">
                    <!-- Label -->
                    <label>
                        邮箱
                    </label>
                    <!-- Input -->
                    <input type="email" class="form-control" placeholder="请输入你的邮箱" name="email">
                </div>

                <!-- Password -->
                <div class="form-group">
                    <!-- Label -->
                    <label>
                        密码
                    </label>
                    <!-- Input -->
                    <input type="password" name="password" class="form-control" placeholder="请输入你的密码">
                </div>

                <div class="form-group">
                    <!-- Label -->
                    <label>
                        确认密码
                    </label>
                    <!-- Input -->
                    <input type="password" name="password_confirmation" class="form-control" placeholder="请输入你的密码">
                </div>

                <div class="form-group">
                    <!-- Label -->
                    <label>
                        验证码
                    </label>
                    <!-- Input -->
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="code" value="" placeholder="请输入你的验证码">
                        <span class="input-group-append">
                            <button class="btn btn-default" type="button" id="bt">发送验证码</button>
                        </span>
                    </div>
                </div>

                <!-- Submit -->
                <button class="btn btn-lg btn-block btn-primary mb-3">
                    注册
                </button>

                <!-- Link -->
                <div class="text-center">
                    <small class="text-muted text-center">
                        如果已有账号? <a href="{{route('register')}}">去登陆</a>.
                        <a href="{{route('home')}}">返回首页</a>
                    </small>
                </div>

            </form>

        </div>
        <div class="col-12 col-md-7 col-lg-6 col-xl-8 d-none d-lg-block">

            <!-- Image -->
            <div class="bg-cover vh-100 mt--1 mr--3"
                 style="background-image: url({{asset('org/assets')}}/img/covers/auth-side-cover.jpg);"></div>

        </div>
    </div> <!-- / .row -->
</div>

<!-- JAVASCRIPT
================================================== -->


<!-- Theme JS -->
@include('layouts.hdjs')
@include('layouts.message')
<script>
    require(['hdjs'], function (hdjs) {
        var option = {
            //按钮
            el: '#bt',
            //后台链接
            url: '{{route('util.code.send')}}',
            //验证码等待发送时间
            timeout: '{{hd_config('code.code_expires')}}',//（可不设置）
            //表单，手机号或邮箱的INPUT表单
            input: '[name="email"]',
            //发送前执行的动作，返回true时将发送（可不设置）
            before: function () {
                return true;
            }
        };
        hdjs.validCode(option);
    })
</script>
</body>
</html>