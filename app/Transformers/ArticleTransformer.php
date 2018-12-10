<?php

namespace App\Transformers;

use App\Models\Article;
use App\Transformers\CategoryTransformer;
use League\Fractal\TransformerAbstract;

//转换器 （将php数据转换成josn）
class ArticleTransformer extends TransformerAbstract
{
    # 定义可以include可使⽤用的字段
    protected $availableIncludes = ['category','user'];

    # 定义可以include可使⽤用的字段
    public function transform(Article $article)
    {
        return [
            'id' => $article['id'],
            'title' => $article['title'],
            'content' => $article['content'],
//            'created_at' => $article->created_at->toDateTimeString()
            'created_at' => $article->created_at->format('Y-m-d')
        ];
    }
//item获取一个数剧

    //在文章压入用户数据
    public function includeUser(Article $article)
    {
        return $this->item($article->user, new UserTransformer());
    }
    //返回数据(在文章里面压入栏目数据)
    public function includeCategory(Article $article)
    {
        return $this->item($article->category,new CategoryTransformer());
    }

}
