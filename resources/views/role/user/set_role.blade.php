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
                                给用户<span class="text-muted">{{$user['name']}}</span>设置角色
                            </h1>

                        </div>
                    </div> <!-- / .row -->

                </div>
            </div>
            <!-- Card -->
            <form action="{{route('role.user.setrolestore',$user)}}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                请选择角色
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($roles as $role)
                                        <div class="col-2">
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <input type="checkbox" id="role0" name="role[]" value="{{$role['name']}}" @if($user->hasRole($role['name'])) checked @endif>
                                                    <label for="role0" class="form-check-label">
                                                        {{$role['title']}} | {{$role['name']}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <button class="btn btn-primary">保存</button>
            </form>
        </div>
    </div>
@endsection