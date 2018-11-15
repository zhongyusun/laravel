
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
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/css/theme.min.css">

    <title>密码重置</title>
</head>
<body class="d-flex align-items-center bg-white border-top-2 border-primary">

<!-- CONTENT
================================================== -->
<div class="container">
    <div class="row align-items-center">
        <div class="col-12 col-md-6 offset-xl-2 offset-md-1 order-md-2 mb-5 mb-md-0">

            <!-- Image -->
            <div class="text-center">
                <img src="{{asset('org/assets')}}/img/illustrations/coworking.svg" alt="..." class="img-fluid">
            </div>

        </div>
        <div class="col-12 col-md-5 col-xl-4 order-md-1 my-5">

            <!-- Heading -->
            <h1 class="display-4 text-center mb-3">
                重置密码
            </h1>

            <!-- Subheading -->
            <p class="text-muted text-center mb-5">
                 请牢记您的密码避免丢失
            </p>

            <!-- Form -->
            <form method="post" action="{{route('passwordpost')}}">
                @csrf
                <!-- Email address -->
                <div class="form-group">
                    <!-- Label -->
                    <label>邮箱</label>
                    <!-- Input -->
                    <input type="email" name="email" class="form-control" placeholder="请输入您的邮箱">
                </div>

                <div class="form-group">
                    <!-- Label -->
                    <label>
                        新密码
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
                   提交
                </button>
                <!-- Link -->
                <div class="text-center">
                    <small class="text-muted text-center">
                        还没有账号? <a href="{{route('login')}}">去注册</a>.
                        如果已有账号? <a href="{{route('register')}}">去登陆</a>.
                        <a href="{{route('home')}}">返回首页</a>
                    </small>
                </div>

            </form>

        </div>
    </div> <!-- / .row -->
</div> <!-- / .container -->

<!-- JAVASCRIPT
================================================== -->
@include('layouts.hdjs')
@include('layouts.message')
<script>
    require(['hdjs'], function (hdjs) {
        var option = {
            //按钮
            el: '#bt',
            //后台链接
            url: '{{route('code.send')}}',
            //验证码等待发送时间
            timeout: 10,//（可不设置）
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