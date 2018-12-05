<?php

namespace App\Http\Controllers\Role;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index(){
        //获取所有模块表 modules 数据
        $modules=Module::all();
        //dd($modules);
        return view('role.permission.index',compact('modules'));
    }

}
