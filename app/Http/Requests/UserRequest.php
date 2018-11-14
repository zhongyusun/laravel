<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * 定义验证规则
     * php artisan make:request StoreBlogPost
     * @return array
     */
    /**
     * @return array
     * required   输入不能为空
     *  unique:users  唯一
     *  email   邮箱格式必须正确
     *  min:3  最少不能少于三个字符
     * confirmed 验证字段必须有匹配字段
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'email|unique:users',
            'password'=>'required|min:3|confirmed',
            'code'=>[
                'required',
                //使用表单验证--自定义验证规则--使用闭包
                //$value 表单提交过来的code对应的值
                function ($sakfjdsf,$value, $fail) {
                    if ($value != session('code')) {
                        $fail('验证码不正确');
                    }
                },
            ]
        ];
    }
    //自定义错误内容
    public function messages()
    {
        return [
            'name.required'     =>'请输入昵称' ,
            'email.email'       =>'请输入正确邮箱' ,
            'email.unique'      =>'该邮箱已注册' ,
            'password.required' =>'请输入密码' ,
            'password.min'      =>'密码不得少于3位' ,
            'password.confirmed'=>'两次输入密码不一致' ,
            'code.required'     =>'请输入验证码'
        ];
    }
}



