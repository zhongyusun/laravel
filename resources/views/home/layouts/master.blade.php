
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
    <meta name="csrf-token" content="{{csrf_token()}}">
    {{--引入字体库--}}
    <link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('org/assets')}}/css/theme.min.css">
    @stack('css')
    <title>桀骜</title>
</head>
<body>

{{--头部--}}
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand mr-auto" href="{{route('home')}}">
            <img src="{{asset('org/assets/img/favicon.ico')}}" alt="..." class="navbar-brand-img">
            <span style="color: #00a0e9;font-size: 14px;font-weight: 700">桀骜网</span>
        </a>

        <!-- Form -->
        <form class="form-inline mr-4 d-none d-lg-flex">
            <div class="input-group input-group-rounded input-group-merge" data-toggle="lists" data-lists-values='["name"]'>
                <!-- Input -->
                <input type="search" class="form-control form-control-prepended  dropdown-toggle search" data-toggle="dropdown" placeholder="龙王传说" aria-label="Search">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fe fe-search"></i>
                    </div>
                </div>
            </div>
        </form>
        <div>
            <a href="{{route('home.article.create')}}">
                  <span class="icon">
                    <i class="fe fe-edit-3"></i>
                  </span>
            </a>
        </div>
        <!-- User -->
        <div class="navbar-user">
            @auth()
            <!-- Dropdown -->
            <div class="dropdown mr-4 d-none d-lg-flex">

                <!-- Toggle -->
                <a href="#" class="text-muted" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="icon  @if(auth()->user()->unreadNotifications()->count()==0) @else active @endif">
                    <i class="fe fe-bell"></i>
                  </span>
                </a>
                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="card-header-title">
                                    通知
                                </h5>

                            </div>
                            <div class="col-auto">

                                <!-- Link -->
                                <a href="" class="small">
                                    查看全部通知
                                </a>

                            </div>
                        </div> <!-- / .row -->
                    </div> <!-- / .card-header -->
                    <div class="card-body">
                        <!-- List group -->
                        @if(auth()->user()->unreadNotifications()->count()==0)
                            <p style="color: #00a0e9; font-weight: 400;text-align: center">空空如也</p>
                            @else
                            <div class="list-group list-group-flush my--3">
                                @foreach(auth()->user()->unreadNotifications()->limit(3)->get() as $notification)
                                    <a class="list-group-item px-0" href="{{route('member.notify.show',$notification)}}">

                                        <div class="row">
                                            <div class="col-auto">

                                                <!-- Avatar -->
                                                <div class="avatar avatar-sm">
                                                    <img src="{{$notification['data']['user_icon']}}" alt="..." class="avatar-img rounded-circle">
                                                </div>

                                            </div>
                                            <div class="col ml--2">

                                                <!-- Content -->
                                                <div class="small text-muted">
                                                    <strong class="text-body">{{$notification['data']['user_name']}}</strong> 评论了
                                                    <strong class="text-body">{{$notification['data']['article_title']}}</strong>
                                                </div>

                                            </div>
                                            <div class="col-auto">

                                                <small class="text-muted">
                                                    {{$notification->created_at->diffForHumans()}}
                                                </small>

                                            </div>
                                        </div> <!-- / .row -->

                                    </a>
                                @endforeach
                            </div>
                            @endif


                    </div>
                </div> <!-- / .dropdown-menu -->

            </div>
            @endauth
            <!-- 头像Dropdown -->
            <div class="dropdown">
                <!-- Toggle -->
                @auth()
                    <a href="#" class="avatar avatar-sm avatar-online dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <img src="{{auth()->user()->icon}}" alt="..." class="avatar-img rounded-circle">
                    </a>
                    <!-- Menu -->
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{route('member.user.show',auth()->user())}}" class="dropdown-item">{{auth()->user()->name}}个人中心</a>
                        <a href="" class="dropdown-item">设置</a>
                        @can('view',auth()->user())
                            {{--参数一：那个方法  二：类--}}
                            <a href="{{route('admin.index')}}" class="dropdown-item">后台管理</a>
                        @endcan
                        <hr class="dropdown-divider">
                        <a href="{{route('registerout')}}" class="dropdown-item">退出</a>
                    </div>
                @else
                    <a href="{{route('register',['from'=>url()->full()])}}" class="btn btn-white btn-sm">登录</a>
                    <a href="{{route('login')}}" class="btn btn-white btn-sm">注册</a>
                @endauth
            </div>

        </div>

        <!-- Collapse -->
        <div class="collapse navbar-collapse mr-auto order-lg-first" id="navbar">

            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <input type="search" class="form-control form-control-rounded" placeholder="Search" aria-label="Search">
            </form>

            <!-- Navigation -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home.home')}}">
                        首页
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home.article.index')}}">
                        文章列表
                    </a>
                </li>
            </ul>

        </div>

    </div> <!-- / .container -->
</nav>

{{--内容--}}
{{--占位，在子集里面写--}}
@yield('content')

{{--底部--}}
<div class="Footer">
    <div class="footer_nav">
        <a rel="nofollow" target="_blank" href="http://www.17k.com/aboutus/">关于sun.edu</a>　|　
        <a rel="nofollow" target="_blank" href="http://www.17k.com/aboutus/Cooperation.html">商务合作</a>　|　
        <a target="_blank" href="http://www.17k.com/aboutus/link.html">友情链接</a>　|　
        <a rel="nofollow" target="_blank" href="http://www.17k.com/Simple/contents/helpCenter/helpCenter.htm">帮助中心</a>　|　
        <a rel="nofollow" target="_blank" href="http://www.17k.com/Simple/contents/login/Rdme.html">用户守则</a>　|　
        <a target="_blank" href="http://www.17k.com/about/sitemap.html">网站地图</a>　|　
        <a rel="nofollow" target="_blank" href="http://www.17k.com/recruitment/index.html">诚聘精英</a>　|　
        <a rel="nofollow" target="_blank" href="http://code.17k.com/">桀骜开源</a>
    </div>
    <p>
        Copyright (C) 2006-2015 www.17k.com All Rights Reserved 中文在线版权所有，
        <a target="_blank" href="http://www.17k.com/dushi/">都市小说</a>、
        <a target="_blank" href="http://www.17k.com/xuanhuan/">玄幻仙侠</a>、
        <a target="_blank" href="http://mm.17k.com/">言情小说</a>等在线小说阅读网站，未经许可不得擅自转载本站内容。<br>
        桀骜小说网所收录免费小说作品、社区话题、书友评论、用户上传文字、图片等其他一切内容均属用户个人行为，与桀骜小说网无关。--桀骜权利声明。<br>

        <a rel="nofollow" target="_blank" href="http://www.miibeian.gov.cn/">京ICP证010590号</a>　京ICP备09030667号-5　　　京网文[2014]0917-217号　　新出审字[2009]366号　<br>
        <a rel="nofollow" target="_blank" href="http://cms.17k.com/news/182.html">新出网许（京）字045号</a>　北京市公安局备案号码：123492883780<br>
        违法和不良信息举报电话：17638171383 举报邮箱：2460245313@qq.com</p>
    <p class="linkimg">
        <a href="https://ss.knet.cn/verifyseal.dll?sn=e13062011010041317xgep000000&amp;ct=df&amp;a=1&amp;pa=0.9085826601367444" target="_blank" kx_type="图标式">
            <img src="http://rr.knet.cn/static/images/logo/cnnic.png" alt="可信网站">
        </a>
        <a rel="nofollow" target="_blank" href="http://www.bj.cyberpolice.cn/index.do">
            <img src="http://img.17k.com/channel/nvxing/-2.jpg" alt="网络110报警">
        </a>
        <a href="http://v.pinpaibao.com.cn/authenticate/cert/?site=www.17k.com&amp;at=business" target="_blank">
            <img src="http://static.anquan.org/static/outer/image/hy_124x47.png" alt="安全联盟认证" width="124" height="47">
        </a>
        <a rel="nofollow" target="_blank" href="http://net.china.com.cn/index.htm">
            <img src="http://img.17k.com/channel/nvxing/-1.jpg" alt="不良网站举报">
        </a>
        <a rel="nofollow" target="_blank" href="http://www.bjwhzf.gov.cn/accuse.do">
            <img src="http://img.17k.com/channel/nvxing/-3.jpg" alt="北京文化市场行政执法队">
        </a>
    </p>

</div>
<style>
    .Footer{
        margin-top: 50px;
        clear: both;
        padding: 10px 0;
        border-top: 5px solid #e0e0e0;
        color: #666;
        background: 0 0;
        font: 12px/1.5 'MicroSoft YaHei'
    }
    .footer_nav{
        font-size: 14px;
        text-align: center;
        color: #ddd;
    }
    .Footer p{
        text-align: center;
        font-size: 12px;
    }
    .Footer a{
        color: #333;
    }
</style>
@include('layouts.hdjs')
@include('layouts.message')
<script>
    require(['bootstrap'])
</script>
@stack('js')
@stack('css')
</body>
</html>
