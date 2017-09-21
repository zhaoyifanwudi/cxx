@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/index/info')}}">首页</a> &raquo; 关于我们
    </div>
    <!--面包屑导航 结束-->

    <!--结果集标题与导航组件 开始-->
    <div class="result_wrap">
        <div class="result_title">

            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">

        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/about/update')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>书院简介：</th>
                    <td>
                        <textarea name="about_abstract">{{$data->abstract}}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>具体介绍：</th>
                    <td>
                        <script type="text/javascript" charset="utf-8" src="{{asset('style/org/ueditor/ueditor.config.js')}}"></script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('style/org/ueditor/ueditor.all.min.js')}}"> </script>
                        <script type="text/javascript" charset="utf-8" src="{{asset('style/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                        <script id="editor" name="art_content" type="text/plain" style="width:860px;height:500px;">{!!$data->introduce!!}</script>
                        <script>
                        var ue = UE.getEditor('editor');
                        </script>
                        <style>
                            .edui-default{line-height: 28px;}
                            div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                            {overflow: hidden; height:20px;}
                            div.edui-box{overflow: hidden; height:22px;}
                        </style>
                    </td>
                </tr>
                <tr>
                    <th>书院环境图片：</th>
                    <td>



                        <div id="divPreview">
                            {{$data->img}}
                        </div>
                    </td>
                </tr>

                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
                </tr>
                </tbody>
            </table>
        </form>

    </div>
    <script type="text/javascript" src="{{asset('style/org/jquery-3.2.1.js')}}"></script>
    <script type="text/javascript" src="{{asset('style/org/uploadify/jquery.uploadify.js')}}"></script>
    <script>
        $(function() {
            $("#fileField").uploadify({
                'height'        : 30,
                'swf'       : "{{asset('style/org/uploadify/uploadify.swf')}}",
                'uploader'      :"{{url('admin/about/upload')}}",
                'width'         : 120,
                'onUploadSuccess' : function(file, data, response) {
                    var info = eval("("+data+")");
                    if(info.err==1){alert(info.msg);}                                       //如果图片过大或者格式错误弹出错误信息
                    else{
                        $("#divPreview").append($("<img src='" + info.img + "'/>"));
                        $("#divPreview").append($("<input type='hidden' name='imgId[]' value='" + info.imgId + "'/>"));
                    }
                },
                'buttonText'    : '浏览文件',
                'uploadLimit'   : 5,                                                                      //上传最多图片张数
                'removeTimeout' : 1,
                'preventCaching': true,                                                           //不允许缓存
                'fileSizeLimit' : 4100,                                                              //文件最大
                'formData'      : {
                    '_token' :"{{csrf_token()}}",
                },
            });
            $("#SWFUpload_0").css({                  //设置按钮样式，根据插件文档进行修改
                'position' :'absolute',
                'top': 20,
                'left': 35,
                'z-index'  : 1
            });
        });
    </script>

@endsection