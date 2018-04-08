<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>西南石油大学培训中心 - 登录后台管理</title>
		<!--main开始-->
<link rel='stylesheet' href='http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css'>
<link rel="stylesheet" type="text/css" href="/trainer/Public/css/admin.css"/>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="http://apps.bdimg.com/libs/layer/2.1/layer.js" type="text/javascript" charset="utf-8"></script>
<!--main结束-->
		<style type="text/css">
			body{color: white;}
			.backgroud{background:#3a3a3a url('http://ww4.sinaimg.cn/large/ac4b88d5gy1fda1o30m0fj218g0rsq65.jpg') no-repeat fixed;height: 1000px; background-size:cover; -webkit-background-size:cover; -o-background-size:cover;padding-top:5em;}
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
								<form>
									<div class="input-group">
										 <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
										<input class="form-control" type="text" id="nickname" placeholder="请输入用户名" />
									</div>
									<div class="input-group">
										 <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
										<input class="form-control" type="password" id="pwd" placeholder="请输入密码" />
									</div>
									<div class="text-center">
										<input class="btn btn-primary" type="button" id="btn" value="登录" />
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-xs-1 col-sm-3 col-md-4"></div>
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
		<script type="text/javascript">
			$('#btn').click(function(){
				var nickname = $.trim($('#nickname').val());
				var pwd = $.trim($('#pwd').val());
				if(nickname == ''){
					layer.msg('用户名不可为空');
					document.getElementById("nickname").focus();
					return false;
				}else if(pwd == ''){
					layer.msg('密码不可为空');
					document.getElementById("pwd").focus();
					return false;
				}
				$.post("<?php echo U('Login/getAdmin');?>",{nickname:nickname,pwd:pwd},function(data){
					layer.msg(data.msg);
					if(data.error == 0){
						window.location.href = "<?php echo U('Index/index');?>";
					}
				},'json');
			});
			function changeBtn(){
				var btn = document.getElementById("btn");
				if(btn.disabled == true){
					btn.disabled = false;
					btn.value = '登录';
				}else{
					btn.disabled = true;
					btn.value = '登录中...';
				}
			}
			//点击回车键事件
			$(document).keydown(function(e) {
				var key = (e.keyCode) || (e.which) || (e.charCode); //兼容IE(e.keyCode)和Firefox(e.which)
				if (key == "13") { //Enter
					$('#btn').trigger('click');
				}
			});
		</script>
	</body>
</html>