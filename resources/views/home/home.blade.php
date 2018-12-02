{{--继承父级‘master.blade.php’--}}
@extends('home.layouts.master')
{{--填充父级@yield('content')--}}
@section('content')

    <div class="container mt-5">
        <div id="demo" class="container carousel slide" data-ride="carousel">
                <!-- 指示符 -->
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                </ul>
                <!-- 轮播图片 -->
                <div class="carousel-inner" >
                    <div class="carousel-item active">
                        <img src="https://static.runoob.com/images/mix/img_fjords_wide.jpg"  style="height: 100%;width: 100%;!important;">
                    </div>
                    <div class="carousel-item">
                        <img src="https://static.runoob.com/images/mix/img_nature_wide.jpg" style="height: 100%;width: 100%;!important;">
                    </div>
                    <div class="carousel-item">
                        <img src="https://static.runoob.com/images/mix/img_mountains_wide.jpg" style="height: 100%;width: 100%;!important;">
                    </div>
                </div>

                <!-- 左右切换按钮 -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

            </div>
        <div class="container mt-3">
            <div class="row">
                <div class="col-12">
                    <!-- Files -->
                    <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">

                                    <!-- Title -->
                                    <h4 class="card-header-title">
                                        动态
                                    </h4>

                                </div>
                            </div> <!-- / .row -->
                        </div>
                        <div class="card-body">
                            <!-- List group -->
                            <div class="list-group list-group-flush my--3">
                                @foreach($articles as $article)
                                    {{--                                {{dd($article)}}--}}
                                    {{--{{dd($article->properties['attributes']['title'])}}--}}
                                    @if($article['log_name']=='article')
                                        @include('home.layouts._artice')
                                    @else

                                        @include('home.layouts._comment')
                                    @endif
                                @endforeach
                            </div>

                        </div>

                        <!-- List -->
                        {{$articles->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
