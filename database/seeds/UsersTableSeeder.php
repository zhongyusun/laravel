<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        DB::table('users')->insert([
//            'name' => str_random(10),
//            'email' => str_random(10).'@gmail.com',
//            'password' => bcrypt('secret'),
//        ]);
        //调用模型工厂一次性生成10个数据
        factory(App\User::class, 10)->create();
        //向数据库中替换第一条数据
        $user=App\User::find(1);
        $user->name='桀骜';
        $user->email='2460245313@qq.com';
        $user->password = bcrypt('123456');
        $user->is_admin = true;
        $user->save();
    }
}
