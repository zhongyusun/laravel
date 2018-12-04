{{--继承父级‘master.blade.php’--}}
@extends('home.layouts.master')
{{--填充父级@yield('content')--}}
@section('content')

    <div class="container mt-5">

        <div class="container mb-3">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach($datas as $data)
                        <div class="swiper-slide">
                            <img src="{{$data['path']}}" alt="" style="width: 100%;height: 500px">
                        </div>
                    @endforeach
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
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
@push('css')
    <link rel="stylesheet" href="{{asset('org/css/swiper.min.css')}}">
    <style>
        html, body {
            position: relative;
            height: 100%;
        }
        body {
            background: #eee;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color:#000;
            margin: 0;
            padding: 0;
        }
        .swiper-container {
            width: 100%;
            height: 100%;

        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
    </style>
    @endpush
@push('js')
    <script>
        require(['hdjs'], function (hdjs) {
            hdjs.swiper('.swiper-container', {
                loop: true,
                //自动轮换
                autoplay: {
                    delay: 2000,
                },
                //如果需要分页器
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                //如果需要前进后退按钮
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            })
        })
    </script>
@endpush