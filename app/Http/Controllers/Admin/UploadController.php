<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Input;
use App\Model\User;
class UploadController extends Controller
{
    public function uploads(Request $request)
    {
        $photo = $request->file('uploads');
        // return $photo;
        if($photo->isValid()){
                //修改文件名并存入upload文件夹
                $extension = $photo->getClientOriginalExtension();
                $newName = date('YmdHis').mt_rand(100,999).".".$extension;
                $path = $photo -> move(public_path().'/uploads/user',$newName);
                $photo = 'uploads/user/'.$newName;
        }
        return '/uploads/user/'.$newName;
    }
}
