@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">

        <!-- Header -->
        <div class="header mt-md-2">
            <div class="header-body">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Title -->
                        <h2 class="header-title">
                            角色管理
                        </h2>

                    </div>

                </div> <!-- / .row -->
                <div class="row align-items-center">
                    <div class="col">

                        <!-- Nav -->
                        <ul class="nav nav-tabs nav-overflow header-tabs">
                            <li class="nav-item">
                                <a href="{{route('role.role.index')}}" class="nav-link ">
                                    角色列表
                                </a>

                            </li>
                            <li class="nav-item">
                                <a href="{{route('role.role.create')}}" class="nav-link active">
                                    添加角色
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row justify-content-center mt-6">
            <div class="col-12 col-lg-10 col-xl-8">
                <!-- Card -->
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('role.role.store')}}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">角色中文名称</label>
                                <input type="text" value="" name="title" class="form-control" id="exampleInputEmail1"
                                       placeholder="请输入角色中文名称">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">角色英文表示</label>
                                <input type="text" value="" name="name" class="form-control" id="exampleInputEmail1" placeholder="请输入角色英文表示">
                            </div>
                            <button type="submit" class="btn btn-primary">保存数据</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




