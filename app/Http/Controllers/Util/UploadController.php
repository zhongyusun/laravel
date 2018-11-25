<?php

namespace App\Http\Controllers\Util;

use App\Exceptions\UploadException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

    //上传手册参考(文件存储--文件上传)：http://www.houdunren.com/edu/section/107
class UploadController extends Controller
{
    //处理上传
    public function uploader(Request $request){
        //打印测试，看上传之后代码是否执行到这里
        // dd(1);

        //dd(asset(''));//http://yu.edu/"
        //dd(storage_path(''));//"D:\houtai\www\laravel\storage"

        //$path = $request->file('上传表单name名')->store('上传文件存储目录','指定磁盘(对应config/filesystem.php中disk)');
        //dd($_FILES);//来查看上传表单的name

        //$path=$request->file('file')->store('avatars');
        //默认在storage目录中app/avatars里面
        //return $path;

        //以下这句话中第一个attachment意思上传文件存储目录
        //第二个attachment对应config/filesystem.php中disk选项中attachment


        $file=$request->file('file');
        //dd($file);
        //对文件上传的大小和类型进行拦截
        $this->checkSize($file);
        $this->checkType($file);

        if ($file){
            $path=$file->store('attachment','attachment');
            //将上传数据储存到数据表
            //我们创建附件的模型与迁移文件
            //关联添加
            auth()->user()->attachment()->create([
                //$file->getClientOriginalName()获取客户端原始文件名
                'name'=>$file->getClientOriginalName(),
                'path'=>url($path)
            ]);
            //dd($path);
        }
        return ['file' =>url($path), 'code' => 0];
    }
    //验证图片上传大小
    public function checkSize($file){
        if ($file->getSize()>200000){
            //return  ['message' =>'上传文件过大', 'code' => 403];
            //使用异常类处理上传异常
            //在laravels手册错误处理Renfer方法
            //创建异常类:exception
            throw new UploadException('上传文件过大');
        }
    }

    //验证图片类型
    public function checkType($file){
        if (in_array(strtolower($file->getClientOriginalName()),['png','jpg','jpeg'])){
            //return  ['message' =>'类型不允许', 'code' => 403];
            throw new UploadException('上传类型不允许');
        };
    }
    //获取图片列表
    public function filesLists(){
        $files=auth()->user()->attachment()->paginate(1);
        //dd($files);
        $data=[];
        foreach ($files as $file){
            $data[]=[
                'url'=>$file['path'],
                'path'=>$file['path']
            ];
        }
        return[
            'data'=>$data,
            'page'=>$files->links().'',//这里一定要注意分页后面拼接一个空字符串
            'code'=>0
        ];
    }
}
