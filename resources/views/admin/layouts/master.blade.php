
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/fonts/feather/feather.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/highlight/styles/vs2015.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/quill/dist/quill.core.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="{{asset('org/assets')}}/libs/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Theme CSS -->
    @stack('css')
    <link rel="stylesheet" href="{{asset('org/assets')}}/css/theme.min.css">
    <title>后台管理</title>

</head>
<body>

<!-- MODALS
================================================== -->
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white">

    <div class="container-fluid">

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand" href="#!">
            <img src="{{asset('org/assets/img/favicon.ico')}}" style="width:50px;height: 50px" class="navbar-brand-img
          mx-auto" alt="...">
        </a>

        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <!-- Navigation -->
            <form class="form-inline mr-4 d-none d-lg-flex" method="get" action="{{route('home.search')}}">
                <div class="input-group input-group-rounded input-group-merge" data-toggle="lists" data-lists-values='["name"]'>
                    <!-- Input -->
                    <input type="text" name="wd" class="form-control  form-control-prepended  dropdown-toggle search" data-toggle="dropdown" placeholder="龙王传说" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fe fe-search"></i>
                        </div>
                    </div>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.index')}}">
                        <i class="fe fe-home"></i>首页
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sidebarPages" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPages">
                        <i class="fe fe-file"></i> 文章系统
                    </a>
                    <div class="collapse" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.category.index')}}" class="nav-link" >
                                    栏目管理
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.flash.index')}}" class="nav-link" >
                                    轮播图管理
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#sidebarLayoutes" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="fe fe-user"></i> 权限管理
                    </a>
                    <div class="collapse " id="sidebarLayoutes">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.config/edit',['name'=>'base'])}}" class="nav-link">
                                    用户管理
                                </a>
                                <a href="{{route('role.role.index')}}" class="nav-link">
                                    角色管理
                                </a>
                                <a href="{{route('role.permission.index')}}" class="nav-link">
                                    权限列表
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#sidebarLayouts" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="fe fe-layout"></i> 网站配置
                    </a>
                    <div class="collapse " id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.config/edit',['name'=>'base'])}}" class="nav-link">
                                    基础配置
                                </a>
                                <a href="{{route('admin.config/edit',['name'=>'upload'])}}" class="nav-link">
                                    上传配置
                                </a>
                                <a href="{{route('admin.config/edit',['name'=>'email'])}}" class="nav-link">
                                    邮箱配置
                                </a>
                                <a href="{{route('admin.config/edit',['name'=>'search'])}}" class="nav-link">
                                    搜索配置
                                </a>
                                <a href="{{route('admin.config/edit',['name'=>'wechat'])}}" class="nav-link">
                                    微信配置
                                </a>
                                <a href="{{route('admin.config/edit',['name'=>'code'])}}" class="nav-link">
                                    验证码配置
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#sidebarLayout" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="fe fe-layout"></i> 微信管理
                    </a>
                    <div class="collapse" id="sidebarLayout">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('wechatbutton.index')}}" class="nav-link">
                                    微信菜单
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('wechatresponse_text.index')}}" class="nav-link">
                                    文本回复
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('wechatresponse_news.index')}}" class="nav-link">
                                    图文回复
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('wechatresponse_base.create')}}" class="nav-link">
                                    基本回复
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="my-3">

            <!-- Heading -->
            <h6 class="navbar-heading text-muted">
                ❀❀❀❀❀❀❀❀❀❀❀❀❀❀❀❀
            </h6>

            <!-- Navigation -->


            <!-- User (md) -->
            <div class="navbar-user mt-auto d-none d-md-flex">

                <!-- Icon铃铛 -->


                <!-- Dropup -->
                <div class="dropup">

                    <!-- Toggle -->
                    <a href="#!" id="sidebarIconCopy" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-sm avatar-online">
                            <img src="{{auth()->user()->icon}}" class="avatar-img rounded-circle" alt="...">
                        </div>
                    </a>

                    <!-- Menu -->
                    <div class="dropdown-menu" aria-labelledby="sidebarIconCopy">
                        <a href="{{route('member.user.show',auth()->user())}}" class="dropdown-item">个人中心</a>
                        <a href="{{route('home.home')}}" class="dropdown-item">首页</a>
                        <hr class="dropdown-divider">
                        <a href="{{route('registerout')}}" class="dropdown-item">退出</a>
                    </div>

                </div>
            </div>
        </div> <!-- / .navbar-collapse -->
    </div> <!-- / .container-fluid -->
</nav>
<!-- MAIN CONTENT
================================================== -->



<div class="main-content">
   @yield('content')
</div>

<!-- JAVASCRIPT
================================================== -->
@include('layouts.hdjs')
@include('layouts.message')

<script>
    require(['bootstrap'])
</script>
@stack('js')

</body>
</html>