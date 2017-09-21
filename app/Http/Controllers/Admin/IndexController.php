<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Login;
use Validator;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function info()
    {
        return view('admin.info');
    }
    //更改超级管理员密码
    public function pass(Request $request)
    {
        if($input = $request->all()){

            $rules = [
                'password'=>'required|between:6,20|confirmed',
            ];

            $message = [
                'password.required'=>'新密码不能为空！',
                'password.between'=>'新密码必须在6-20位之间！',
                'password.confirmed'=>'新密码和确认密码不一致！',
            ];

            $validator = Validator::make($input,$rules,$message);

            if($validator->passes()){
                $user = Login::first();
                $_password = $user->pass;
                if($input['password_o']==decrypt($_password)){
                    $user->pass = encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','密码修改成功！');
                }else{
                    return back()->with('errors','原密码错误！');
                }
            }else{
                return back()->withErrors($validator);
            }

        }else{
            return view('admin.pass');
        }
    }
}
