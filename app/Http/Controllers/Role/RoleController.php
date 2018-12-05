<?php

namespace App\Http\Controllers\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {

    }


    public function edit(Role $role)
    {

        return view('role.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $role->update($request->all());
        //dd($request->all());
        return redirect()->route('role.role.index')->with('success','编辑成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //dd($role);
        $role->delete();
        return redirect()->route('role.role.index')->with('success','删除成功');
    }
}
