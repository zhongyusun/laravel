<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use phpDocumentor\Reflection\Types\Null_;

//创建策略   在手册用户授权  创建策略
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\user  $model
     * @return mixed
     */
    //参数(当前登录用户，传递进来的模型)
    public function view(User $user, user $model)
    {
        //检测当前用户是否为管理员
        return $user->is_admin==1;
    }




    //判断指定用户是否为登录用户
    public function isMine(User $user,User $model){
        return $user->id==$model->id;
    }
    //检测当前用户是不是同一个用户
    public function isNotMine(User $user,User $model){
        return $user->id!=$model->id  ||$model==Null_::class;
    }
}
