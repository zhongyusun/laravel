<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('')->comment('文章标题');
            //index()添加索引
            $table->unsignedInteger('user_id')->index()->default(0)->comment('文章作者');
            //外键约束：数据库迁移-->外键约束   在app中Models中定义关联
            //通过外键user_id找到数据表users里面id，当删除该id时所关联的表也会删除
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('category_id')->index()->default(0)->comment('栏目id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
