<?php

namespace App\Http\Controllers\Role;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin.auth', [
            'except' => [],
        ]);
    }

    public function index()
    {
        //获取所有Role表的数据
        $roles=Role::all();
        //dd($roles);
        return view('role.role.index',compact('roles'));
    }


    public function create()
    {


        return view('role.role.create');
    }


    public function store(Request $request)
    {
        //dd($request->all());
        Role::create($request->toArray());
        return redirect()->route('role.role.index')->with('success','添加成功');
    }



    //展示角色设置权限的模板页面
    public function show(Role $role)
    {
        ////获取所有模块以及权限,获取的 modules 所有数据
        $modules=Module::all();
        //dd($role);
        return view('role.role.set_permission',compact('role','modules'));
    }
    //设置角色权限
    public function setrolepermission(Role $role,Request $request){
        //给角色设置权限
        //dd($role->toArray());
        //dd($request->all());
        $role->syncPermissions($request->permissions);
        //dd($qq);
        return back()->with('success','操作成功');
    }




    public function edit(Role $role)
    {

        return view('role.role.edit',compact('role'));
    }


    public function update(Request $request, Role $role)
    {

        $role->update($request->all());
        //dd($request->all());
        return redirect()->route('role.role.index')->with('success','编辑成功');
    }


    public function destroy(Role $role)
    {
        //dd($role);
        $role->delete();
        return redirect()->route('role.role.index')->with('success','删除成功');
    }
}
