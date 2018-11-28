@extends('home.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            @include('member.layouts.menu')
            <div class="col-sm-9">
                <div class="container-fluid">
                    <div class="header-body mt--5 ">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Nav -->
                                <ul class="nav nav-tabs nav-overflow header-tabs">
                                    <li class="nav-item">
                                        <a href="{{route('member.my_like',[$user,'type'=>'article'])}}" class="nav-link">
                                            文章
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('member.my_like',[$user,'type'=>'comments'])}}" class="nav-link active">
                                            评论
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12">
                            <!-- Files -->
                            <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                                <div class="card-header">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <!-- Title -->
                                            <h4 class="card-header-title">
                                                我赞过的评论
                                            </h4>
                                        </div>
                                    </div> <!-- / .row -->
                                </div>
                                <div class="card-body">

                                    <!-- List -->
                                    <ul class="list-group list-group-lg list-group-flush list my--4">
                                        @foreach($likesData as $like)
                                            <li class="list-group-item px-0">

                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <!-- Avatar -->
                                                        <a href="" class="avatar avatar-sm">
                                                            <img src="{{$like->belongsModel->user->icon}}" alt="..." class="avatar-img rounded">
                                                        </a>

                                                    </div>
                                                    <div class="col ml--2">

                                                        <!-- Title -->
                                                        <h4 class="card-title mb-1 name">
                                                            <a href="">
                                                                {{$like->belongsModel->content}}</a>
                                                        </h4>

                                                        <p class="card-text small mb-1">
                                                            <a href="" class="text-secondary mr-2">
                                                                <i class="fa fa-user-circle" aria-hidden="true"></i> {{$like->belongsModel->user->name}}
                                                            </a>

                                                            <i class="fa fa-clock-o" aria-hidden="true"></i> {{$like->belongsModel->created_at->diffForHumans()}}

                                                        </p>

                                                    </div>
                                                    <div class="col-auto">

                                                        <!-- Dropdown -->
                                                        {{--<div class="dropdown">--}}
                                                            {{--<a href="#!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                                                {{--<i class="fe fe-more-vertical"></i>--}}
                                                            {{--</a>--}}
                                                            {{--<div class="dropdown-menu dropdown-menu-right">--}}
                                                                {{--@if($like->where('user_id',auth()->id())->first())--}}
                                                                    {{--<a class="btn btn-block btn-danger" href="{{route('home.like/make',['type'=>'article','id'=>$like['like_id']])}}">👍--}}
                                                                        {{--取消赞</a>--}}
                                                                {{--@else--}}
                                                                    {{--<a class="btn btn-white"--}}
                                                                       {{--href="{{route('home.like/make',['type'=>'article','id'=>$like['like_id']])}}">👍 点赞</a>--}}
                                                                {{--@endif--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}

                                                    </div>
                                                </div> <!-- / .row -->

                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>

                            {{$likesData->appends(['type'=>Request::query('type')])->links()}}
                        </div>
                    </div> <!-- / .row -->
                </div>
            </div>

        </div>
    </div>
@endsection