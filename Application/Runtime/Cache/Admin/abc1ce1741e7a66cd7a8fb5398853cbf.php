<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>西南石油大学培训中心 - 后台管理</title>
	<!--main开始-->
<link rel='stylesheet' href='http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css'>
<link rel="stylesheet" type="text/css" href="/trainer/Public/css/admin.css"/>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="http://apps.bdimg.com/libs/layer/2.1/layer.js" type="text/javascript" charset="utf-8"></script>
<!--main结束-->
	<link rel="stylesheet" type="text/css" href="/trainer/Public/css/local.css"/>
	<script type="text/javascript">
		$(function () {
			$(".side-nav").find("li").each(function () {
				var a = $(this).find("a:first")[0];
				if ($(a).attr("href") === location.pathname) {
					$(this).addClass("active");
				} else {
					$(this).removeClass("active");
				}
			});
		})
	</script>
</head>
<body>
<div id="wrapper">
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">            
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo U('Index/index');?>">培训中心 控制面板</a>
		</div>
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav">
				<li class="active"><a href="<?php echo U('Index/index');?>"><i class="glyphicon glyphicon-level-up"></i> 报名管理</a></li>
				<li><a href="<?php echo U('Classgroup/index');?>"><i class="glyphicon glyphicon-th-list"></i> 班级管理</a></li>
				<li><a href="<?php echo U('Meal/index');?>"><i class="glyphicon glyphicon-time"></i> 日常管理</a></li>
				<li><a href="<?php echo U('Invoice/index');?>"><i class="glyphicon glyphicon-credit-card"></i> 发票管理</a></li>                 
			</ul>
			<ul class="nav navbar-nav navbar-right navbar-user">
				<li class="dropdown user-dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Admin<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo U('Index/fixpwd');?>"><i class="glyphicon glyphicon-edit"></i> 修改密码</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="glyphicon glyphicon-log-out"></i> 退出登录</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	<div id="page-wrapper">
		<!DOCTYPE html>
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
								<form>
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
	</body>
</html>

	</div>
</div>
<script type="text/javascript">
	function getTable(exporturl){
		var tr = document.getElementsByTagName('tr');//获取HTML中表格的tr
		var th = document.getElementsByTagName('th');
		var td = document.getElementsByTagName('td');//获取HTML中表格的td
		var arr2 = new Array()//定义二维数组arr2
		
		for (var i = 0; i < tr.length; i++) { //因为忽略了表头th，所以少了一组tr，故i<tr.length-1
		    arr2[i] = new Array();
		    for (var j = 0; j < (td.length + th.length)/tr.length; j++) { //每一组tr中有的td个数：td.length/(tr.length-1)
		        arr2[i][j] = "";//初始化二位数组为空字符串
		    }
		}
		
		for (var x = 0; x < tr.length; x++) {
		    for (var y = 0; y < (td.length + th.length)/tr.length; y++) {
		    	if(x == 0){ //第一行，即th的标题行
		    		arr2[0][y] = th[y].innerText;
		    	}else{
		    		arr2[x][y] = td[(x-1)*((td.length + th.length)/tr.length)+y].innerText;
		    	}
		    }
		}
		var data = JSON.stringify(arr2);
		exporturl = exporturl.replace('str',data);
		window.open(exporturl);
	}
</script>
</body>
</html>