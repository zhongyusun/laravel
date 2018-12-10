<?php

namespace App\Http\Controllers\Role;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //展示所有的用户
    public function index(){
        //获取所有用户
        $users=User::paginate(10);
        //dd($datas);
        return view('role.user.index',compact('users'));
    }

   // 展示给用户设置角色的面板
    public function setrolecreate(User $user){
       // dd($user);
        //获取所有的角色
        $roles=Role::all();
        //dd($roles);
        //dd($data['0']['name']);
        return view('role.user.set_role',compact('user','roles'));
    }

    public function setrolestore(User $user,Request $request){
        //dd($request->all());
        //dd($user);
        //dd($request);
        $user->syncRoles([$request->role]);
        return back()->with('success','设置成功');
    }
}
