<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //调用模型工厂一次性生成指定的数据
        factory(\App\Models\Article::class,50)->create();
    }
}
