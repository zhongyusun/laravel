<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommentNotify extends Notification
{
    use Queueable;
    protected $comment;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comments)
    {
        $this->comment=$comments;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     * 在手册 消息通知 里面 数据库通知，执行两条命令创建迁移表
     * 创建消息通知类 CommentNotify.php
     * 创建并注册观察者，并指定观察模型，当发评论时候给作者推送消息($comments->article->user->notify(new CommentNotify($comments));)
     * 在首页小铃铛中编辑消息通知页面布局，并将notifications表 data 的字段中的数据循环到页面：auth()->user()->unreadNotifications()
     * 在个人中心创建我的消息页面，创建相应的消息控制类，配置路由
     * 在控制器类中将数据分配到页面上并循环展示
     * 创建已读方法，在方法里(DatabaseNotification,$notify){$notify->markAsRead();并重新定向到文章详情页面}
     * 锚链接 ：在Article.php类中定义getlink让地址栏有锚点
     * 在评论展示页vue中用location.hash接取锚点 并将锚链接拼好 hdjs.scrollTo('body',location.hash,500, {queue:true});
     */
    public function toArray($notifiable)
    {
        //这里 return 数据会记录到数据表 notifications表 data 的字段中
        //$this->comment//评论模型
        return [
            'user_id'=>$this->comment->user->id,//谁发表的评论
            'user_icon'=>$this->comment->user->icon,//发表评论的用户头像
            'user_name'=>$this->comment->user->name,//发表评论的用户的名字
            'article_id'=>$this->comment->article->id,//文章id
            'article_title'=>$this->comment->article->title,//文章名字
            //'link'=>route('home.article.show',$this->comment->article) . '#comment' . $this->comment->id,
            'link'=>$this->comment->article->getLink('#comment'.$this->comment->id)//评论锚链接
        ];
    }
}
