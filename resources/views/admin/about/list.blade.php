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
        <div class="result_content">
            <div class="short_wrap">
                <a href="javascript:;" onclick="delArt()"><i class="fa fa-recycle"></i>删除</a>
                <a href="{{url('admin/about/edit')}}"><i class="fa fa-recycle"></i>编辑</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->

    <div class="result_wrap">
        <form action="{{url('admin/about/add')}}" method="post">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>

                <tr>
                    <th><i class="require">*</i>书院简介：</th>
                    <td>
                        {{$data->abstract}}
                    </td>
                </tr>
                <tr>
                    <th>具体介绍：</th>
                    <td>
                        {!!$data->introduce!!}
                    </td>
                </tr>
                <tr>
                    <th>书院环境图片：</th>
                    <td>

                        <input type="file" name="file" class="file" id="fileField" value="{{$data->img}}" />


                    </td>
                </tr>


                </tr>

                </tbody>
            </table>
        </form>

    </div>
    <script>
        function delArt() {
            layer.confirm('您确定要删除这篇文章吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.post("{{url('admin/about/destroy')}}",{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                    if(data.status==0){
                        location.href = location.href;
                        layer.msg(data.msg, {icon: 6});
                    }else{
                        layer.msg(data.msg, {icon: 5});
                    }
                });
//            layer.msg('的确很重要', {icon: 1});
            }, function(){

            });
        }
    </script>


@endsection