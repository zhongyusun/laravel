@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">

    <div class="col-12">
        <!-- Header -->
        <div class="header mt-md-5">
            <div class="header-body">
                <div class="row align-items-center">
                    <div class="col">
                        <!-- Title -->
                        <h1 class="header-title">
                            用户管理
                        </h1>

                    </div>
                </div> <!-- / .row -->

            </div>
        </div>

        <!-- Card -->
        <div class="card" data-toggle="lists" data-lists-values="[&quot;orders-order&quot;, &quot;orders-product&quot;, &quot;orders-date&quot;, &quot;orders-total&quot;, &quot;orders-status&quot;, &quot;orders-method&quot;]">

            <div class="table-responsive">
                <table class="table table-sm table-nowrap card-table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>用户昵称</th>
                        <th>用户邮箱</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user['id']}}</td>
                        <td>{{$user['name']}}</td>
                        <td>{{$user['email']}}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Button group with nested dropdown">
                                <a href="{{route('role.user.setrole.create',$user)}}" class="btn btn-white">设置角色</a>
                                <a href="http://laravel-test.ishilf.com/role/user/1/edit" class="btn btn-white">编辑</a>
                                <button type="button" onclick="del(this)" class="btn btn-white">删除</button>
                                <form action="http://laravel-test.ishilf.com/role/user/1" method="post">
                                    <input type="hidden" name="_token" value="freaazaXGHUs96hRmvhlDADIDdm0rJiWW0oyoFOh"> <input type="hidden" name="_method" value="DELETE">                                    </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        {{$users->links()}}
    </div>
</div>
@endsection