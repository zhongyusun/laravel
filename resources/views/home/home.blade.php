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
