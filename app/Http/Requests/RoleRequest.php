<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
     *
     * @return array
     */
    public function rules()
    {
        $role = $this->route('role');
        return [
            'title'=>'required|unique:roles,title,' . $role['id'],
            'name'=>'required|unique:roles,name,' . $role['id'],
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'请输入角色中文名称',
            'title.unique'=>'角色中文名称已存在',
            'name.required'=>'请输入角色英文名称',
            'name.unique'=>'角色英文名称已存在',
        ];
    }
}
