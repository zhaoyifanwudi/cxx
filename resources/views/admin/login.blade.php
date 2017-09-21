<!DOCTYPE html>
<html lang="en">
<head>
	<title>陈小春太极后台管理</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('style/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('style/font/css/font-awesome.min.css')}}">
</head>
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h2>欢迎使用管理平台</h2>
		<div class="form">
			@if(session('msg'))
			<p style="color:red">{{session('msg')}}</p>
			@endif
			<form action="" method="post">
				{{csrf_field()}}
				<ul>
					<li>
					<input type="text" name="user_name" class="text"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="user_pass" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					{{--<li>--}}
						{{--<input type="text" class="code" name="code"/>--}}
						{{--<span><i class="fa fa-check-square-o"></i></span>--}}

						{{--<img src="{!! captcha_src() !!}" alt="" onclick="this.src='{!!captcha_src()!!}?'+Math.random()">--}}
					{{--</li>--}}
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
			<p><a href="#">返回首页</a></p>
		</div>
	</div>
</body>
</html>