<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Environment;
use App\About;
use Validator;

class AboutController extends Controller
{
    public function list()
    {
        $data = About::first();
        if($data) {
            return view('admin.about.list',compact('data'));
        }else{
            return redirect('admin/about/add');
        }
    }
    public function add(Request $request)
    {
        if($input = $request->except('_token')){
            $rules = [
                'about_abstract'=>'required',
                'art_content'=>'required',
            ];
            $message = [
                'about_abstract.required'=>'不能为空！',
                'art_content'=>'不能为空！',
            ];
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $about = new About;
                $about->abstract = $input['about_abstract'];
                $about->introduce = $input['art_content'];
                $about->img = $input['file'];

                if($about->save()){
                    return redirect('admin/about/list');
                }else{
                    return back()->with('errors','数据填充失败，请稍后重试！');
                }
            }else{
                return back()->withErrors($validator);
            }

        }else{
            return view('admin.about.add');
        }

    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        if($file->isValid()){
            $entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;
            $create = Environment::create(['name' => $newName,'picture' => $file]);
            return $create ? ['err' => 1,'msg' => '上传成功']:['err' => 0,'msg' => '上传失败'];

        }

    }

    public function edit()
    {
        $data = About::first();
        return view('admin.about.edit',compact('data'));
    }

    public function update(Request $request)
    {
        $input = $request->except('_token','_method');
        $data = About::first();
        $data->abstract = $input['about_abstract'];
        $data->introduce = $input['art_content'];
        $data->img = $input['file'];
        if($data->update()){
            return redirect('admin/about/list');
        }else{
            return back()->with('errors','更新失败，请稍后重试！');
        }
    }

    public function destroy()
    {
        $data = About::first();
        if($data->delete()){
            $data = [
                'status' => 0,
                'msg' => '删除成功！',
            ];
        }else{
            $data = [
                'status' => 1,
                'msg' => '删除失败，请稍后重试！',
            ];
        }
        return $data;
    }
}
