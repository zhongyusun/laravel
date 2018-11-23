<?php

namespace App\Exceptions;

use Exception;

class UploadException extends Exception
{
    //方法把必须要传render不可以变
    public function render(){
        //return response()->json(hdjs要求返回,http状态码);
        //return response()->json(['message' =>'上传文件过大', 'code' => 403],200);
        return response()->json(['message'=>$this->getMessage(),'code'=>403],200);
    }
}
