<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>登录 - 培训中心后台管理</title>
		<!--main开始-->
<link rel='stylesheet' href='http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css'>
<link rel="stylesheet" type="text/css" href="/trainer/Public/css/main.css"/>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<!--main结束--><script type="text/javascript" src="/trainer/Public/validator/jquery.validator.min.js?local=zh-CN" ></script>
		<style type="text/css">
			body{color: white;}
			.backgroud{background:#3a3a3a url('/trainer/Public/images/gw-bg.jpg') no-repeat fixed;height: 1000px; background-size:cover; -webkit-background-size:cover; -o-background-size:cover;padding-top:5em;}
			.col-md-4{margin-top: 70px;}
			.login .logo{font-size: 25px;font-family:"微软雅黑"; text-align: center;margin-bottom: 20px;}
			.login .form{width: 100%;background-color: #EFEFF4;padding: 50px 5% 30px;}
			.input-group{margin-bottom: 12px;}
			.btn{margin-top: 12px;width: 30%;border-radius: 0px;}
			.form-control,.input-group-addon{border-radius: 0px;}
		</style>
	</head>
	<body>
		<div class="backgroud">
			<div class="container">
				<div class="row">
					<div class="col-xs-1 col-sm-3 col-md-4"></div>
					<div class="col-xs-10 col-sm-6 col-md-4">
						<div class="login">
							<div class="logo">培训中心 - 后台管理</div>
							<div class="form">
								<div>
									<div class="input-group">
										 <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
										<input class="form-control" type="text" id="nikename" placeholder="请输入用户名" />
									</div>
									<div class="input-group">
										 <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
										<input class="form-control" type="password" id="pwd" placeholder="请输入密码" />
									</div>
									<div class="text-center">
										<input class="btn btn-primary" type="button" value="登录" />
									</div>
								</div>
							</div>
						</div>
						<style type="text/css">
	.footer{padding: 10px; text-align: center;background-color: #222222;color: #FFFFFF;width: 100%;}
</style>
<div class="footer">
	&copy;<span id="lastYear"></span> - <span id="nowYear"></span>&nbsp;西南石油大学培训中心
</div>
<script>
	var nowDate = new Date();
	document.getElementById("nowYear").innerHTML = nowDate.getFullYear();
	document.getElementById('lastYear').innerHTML = nowDate.getFullYear() - 1 ;
	//定位footer位置
	if(document.documentElement.clientHeight > document.documentElement.offsetHeight-4){	//减4是因为浏览器的边框是2像素, 否则会一直判断有滚动条 
		$('.footer').css({'position': 'absolute', 'bottom': '0px','padding':'10px','text-align':'center','background-color':'#222222;','color':'#FFFFFF','width':'100%'});
	}
</script>
					</div>
					<div class="col-xs-1 col-sm-3 col-md-4"></div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			
		</script>
	</body>
</html>