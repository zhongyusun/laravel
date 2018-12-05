<?php

namespace App\Console\Commands;

use App\Models\Module;
use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HdModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hd_module';

    /**
     * The console command description.
     * 命令的描述
     * @var string
     */
    protected $description = '重新检索文件';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //users  用户表
        //model_has_roles 用户  角色中间表
        //roles  角色表
        //role_has_permission  角色  权限中间表
        //permissions  权限表

        //在生成的权限迁移文件：permissions表中增加 title module 字段
        //在roles表中增加title字段

        //自行创建迁移文件 modules:title(模块中文名称) name(模块英文标识)  permissions(记录模块所有的权限)


        /******************************************/
        //扫描出app/Http/Controllers里面所有的文件
        //glob() 函数返回匹配指定模式的文件名或目录。
        $modules=glob('app/Http/Controllers/*');
        //dump($modules);
        foreach ($modules as $module){
            //dump($module);
            //判断模块里面system 是否为目录
            //is_dir()检测是否为目录
            if (is_dir($module.'/System')){
                //dump($module);
                //获得模块为英文标识
                //basename() php 函数,用户获取整个路径最后一部分
                $moduleName=basename($module);
                //dump($moduleName);
                //获取模块中文名称：System/config.php
                $config=include $module.'/System/config.php';
                //dump($config);
                //获取模块所有的权限
                $permissions=include $module.'/System/permission.php';
                //dump($permissions);
                //将模块数据写入数据表中：title name permissions
                //执行完这条代码，那么modules 表就应该有数据写入
                Module::firstOrNew(['name'=>$moduleName])->fill([
                   'title'=>$config['app'],'permissions'=>$permissions
                ])->save();
                //将所有的设定的权限写进权限表：title name module
                //dump($permissions);
                //执行完这条代码，那么 permission 表就应该有数据写入
                foreach($permissions as $permission){
                    Permission::firstOrNew(['name'=>$moduleName . '-' . $permission['name']])->fill([
                        'title'=>$permission['title'],
                        'module'=>$moduleName
                    ])->save();
                }


            }
        }
        /******************************************/
        //给指定用户设定站长角色，站长角色要拥有所有权限
        //设置一个角色填充文件，系统设定之初就要有一个站长
        //将所有的权限设置给站长
            //找到站长这个角色
            $role=Role::where('name','webmaster')->first();
            //dump($role);
            //获取所有的权限
            $permissions=Permission::pluck('name');
            //dump($permissions);
        //给角色同步权限
            //执行完成之后 role_has_permissions 表应该有数据
            $role->syncPermissions($permissions);
            //获得设置成站长的用户
            $user=User::find(1);
            //dump($user);
            //同步权限
            //注意如果执行报错:App\User 模型中未定义assignRole,解决办法:需要在 User 模型中引入HasRoles类
            $user->assignRole('webmaster');
        //命令清理缓存
            app()['cache']->forget('spatie.permission.cache');
        //命令执行成功提示信息
            $this->info('permission init successfully');
    }
}
