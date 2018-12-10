<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//控制器中资源控制器
class CategoryController extends Controller
{

    //文章类别的分类
    public function index()
    {

        //$categories = Category::all();//获取categories表所有数据
        $categories = Category::paginate(10);//分页
        //dd($categories);
        return view('admin.category.index',compact('categories'));
    }


    public function create()
    {
        return view('admin.category.create');
    }


    public function store(Request $request)
    {
        //dd($request);
        //写入数据库
        Category::create($request->all());

        return redirect()->route('admin.category.index')->with('success','操作成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('admin.category.index')->with('success','修改成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success','删除成功');
    }
}
