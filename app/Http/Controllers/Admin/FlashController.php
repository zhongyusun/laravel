<?php

namespace App\Http\Controllers\Admin;

use App\Models\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FlashController extends Controller
{

    public function index()
    {
        //获取数据库中的数据，并在页面上循环
        $datas=Flash::all();
        //dd($data);
        return view('admin.flash.index',compact('datas'));
    }


    public function create()
    {

        return view('admin.flash.create');
    }


    public function store(Request $request)
    {
        //dd($request->all());
        //添加到数据库
        Flash::create($request->all());
        return redirect()->route('admin.flash.index')->with('success','添加成功');
    }


    public function edit(Flash $flash)
    {
        //dd($flash->id);
        //获取数据库中的数据
        $datas=Flash::find($flash->id);
        //dd($datas);
        return view('admin.flash.edit',compact('datas'));
    }

    public function update(Request $request, Flash $flash)
    {
        //dd($request->all());
        //dd($flash);
        $flash->update($request->all());
        return redirect()->route('admin.flash.index')->with('success','编辑成功');
    }


    public function destroy(Flash $flash)
    {
        $flash->delete();
        return redirect()->route('admin.flash.index')->with('success','删除成功');
    }
}
