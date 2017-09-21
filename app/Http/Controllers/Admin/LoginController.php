<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Login;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if($input = $request->all()){
            $user = Login::first();
            if($user->name != $input['user_name'] || decrypt($user->pass) != $input['user_pass']){
                return back()->with('msg','用户名或者密码错误！');
            }
            session(['user'=>$user]);
            return redirect('admin/index/index');

        }else {
        return view('admin.login');
        }
    }
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }
}
