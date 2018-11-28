@extends('home.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            @include('member.layouts.menu')
            <div class="col-sm-9">
                <!-- Files -->
                <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h4 class="card-header-title">
                                    我的收藏
                                </h4>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    <div class="card-body">
                        <!-- List -->
                        <ul class="list-group list-group-lg list-group-flush list my--4">
                            @foreach($collectData as $collect)
                                <a href="{{route('home.article.show',$collect['collect_id'])}}">
                                    <li class="list-group-item px-0">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <a href="" class="avatar avatar-sm">
                                                    <img src="{{$collect->belongsModel->user->icon}}" alt="..."
                                                         class="avatar-img rounded">
                                                </a>

                                            </div>
                                            <div class="col ml--2">

                                                <!-- Title -->
                                                <h4 class="card-title mb-1 name">
                                                    <a href="">
                                                        {{$collect->belongsModel->title}}</a>
                                                </h4>

                                                <p class="card-text small mb-1">
                                                    <a href="" class="text-secondary mr-2">
                                                        <i class="fa fa-user-circle"
                                                           aria-hidden="true"></i> {{$collect->belongsModel->user->name}}
                                                    </a>

                                                    <i class="fa fa-clock-o"
                                                       aria-hidden="true"></i> {{$collect->belongsModel->created_at->diffForHumans()}}

                                                    <a href="http://www.houdunren.com/edu/topics_1.html"
                                                       class="text-secondary ml-2">
                                                        <i class="fa fa-folder-o" aria-hidden="true"></i>
                                                        {{$collect->belongsModel->category->title}}
                                                    </a>
                                                </p>

                                            </div>
                                            <div class="col-auto">

                                                <!-- Dropdown -->
                                                <div class="dropdown">
                                                    <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button"
                                                       data-toggle="dropdown" aria-haspopup="true"
                                                       aria-expanded="false">
                                                        <i class="fe fe-more-vertical"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        @if($collect->where('user_id',auth()->id())->first())
                                                            <a class="btn btn-block btn-danger"
                                                               href="{{route('home.like/make',['type'=>'article','id'=>$collect['collect_id']])}}">
                                                                取消收藏
                                                            </a>
                                                        @else
                                                            <a class="btn btn-white"
                                                               href="{{route('home.like/make',['type'=>'article','id'=>$collect['like_id']])}}">👍
                                                                点赞</a>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div> <!-- / .row -->

                                    </li>
                                </a>
                                <!-- / .row -->
                            @endforeach

                        </ul>

                    </div>
                </div>
                {{$collectData->appends(['type'=>Request::query('type')])->links()}}
            </div>
        </div> <!-- / .row -->
    </div>
@endsection