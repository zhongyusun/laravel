@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">

                <!-- Header -->
                <div class="header mt-md-2">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h2 class="header-title">
                                    栏目管理
                                </h2>

                            </div>

                        </div> <!-- / .row -->
                        <div class="row align-items-center">
                            <div class="col">

                                <!-- Nav -->
                                <ul class="nav nav-tabs nav-overflow header-tabs">
                                    <li class="nav-item">
                                        <a href="" class="nav-link active">
                                            编辑栏目
                                        </a>

                                    </li>
                                </ul>
                            </div>
                            <div class="col-auto">

                                <!-- Buttons -->
                                <a href="{{route('admin.category.create')}}" class="btn btn-white btn-sm">
                                    添加栏目
                                </a>

                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div> <!-- / .row -->
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">


                <div class="card">
                    <div class="card-body">

                        <form method="post" action="{{route('admin.category.update',$category)}}">
                            @csrf  @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputEmail1">作品标题</label>
                                <input type="text" name="title" class="form-control" value="{{$category['title']}}" id="exampleInputEmail1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">作者</label>
                                <input type="text" name="writer" class="form-control" value="{{$category['writer']}}" id="exampleInputEmail1" placeholder="">
                            </div>
                            <label for="exampleInputEmail1">内容</label>
                            <div class="form-group">

                                <textarea name="content">
                                    {{$category['content']}}
                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">修改</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection