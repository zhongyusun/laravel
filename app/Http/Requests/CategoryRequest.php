<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //接受路由参数  id
        //dd($this->route('category'))
        //判断是增加还是修改
        $id=$this->route('category') ?$this->route('category')->id : null;
        return [
            'title'=>'required|unique:categories,title,' . $id,
            'content'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'title.required'=>'请输入文章标题',
            'title.unique'=>'该标题已存在',
            'content.required'=>'请输入文章内容',
        ];
    }
}
