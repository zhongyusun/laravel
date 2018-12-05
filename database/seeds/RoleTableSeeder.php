<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //给角色添加一个初始角色
        Role::create([
           'title'=>'大哥',
            'name'=>'webmaster'
        ]);
    }
}
