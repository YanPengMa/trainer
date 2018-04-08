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
		});
		
		/**
		 *获取页面的表格数据
		 * lastCol默认为不打印
		 **/
		function getTable(exporturl,lastCol){
			if(!lastCol)lastCol = 1;  //lastCol默认为不打印（兼容IE写法）
			var tr = document.getElementsByTagName('tr');//获取HTML中表格的tr
			var th = document.getElementsByTagName('th');
			var td = document.getElementsByTagName('td');//获取HTML中表格的td
			var arr2 = new Array()//定义二维数组arr2
			
			for (var x = 0; x < tr.length; x++) {
				arr2[x] = new Array();
	//			var yLength = lastCol ? ((td.length + th.length)/tr.length) : (th.length - lastCol);//判断最后一列是否打印
				var yLength = (th.length - lastCol);
				
				for (var y = 0; y < yLength; y++) {
		    		if(x == 0){ //第一行，即th的标题行
			    		arr2[0][y] = th[y].innerText;
			    	}else{
			    		arr2[x][y] = td[(x-1)*((td.length + th.length)/tr.length)+y].innerText;
			    	}
			    }
			}
			var data = JSON.stringify(arr2);
			$.post(exporturl,{chartData:data},function(data){
				if(data.error==0){
					window.open(data.exporturl);
				}else{
					layer.msg(data.msg);return false;
				}
			},'json');
		}
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
				<li><a href="<?php echo U('Advice/index');?>"><i class="glyphicon glyphicon-briefcase"></i> 意见管理</a></li>                 
			</ul>
			<ul class="nav navbar-nav navbar-right navbar-user">
				<li class="dropdown user-dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Admin<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo U('Index/fixpwd');?>"><i class="glyphicon glyphicon-edit"></i> 修改密码</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo U('Login/unsetLogin');?>"><i class="glyphicon glyphicon-log-out"></i> 退出登录</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	<div id="page-wrapper">
		<h2>意见管理 <small>意见建议</small></h2>
<div class="text-right">
	<span id="downExcel" class="btn btn-default"><span  class="glyphicon glyphicon-cloud-download"></span> Excel</span>
</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<tr><th>序号</th><th>姓名</th><th>课程设计</th><th>管理服务</th><th>食宿</th><th>教师教学</th><th>意见</th></tr>
		<?php if(is_array($advice)): foreach($advice as $key=>$data): ?><tr><td><?php echo ($key+1); ?></td><td><?php echo ($data['username']); ?></td><td><?php echo ($data['adviceclass']); ?></td><td><?php echo ($data['adviceservice']); ?></td><td><?php echo ($data['advicedealroom']); ?></td><td><?php echo ($data['adviceteacher']); ?></td><td><?php echo ($data['advicetext']); ?></td></tr><?php endforeach; endif; ?>
	</table>
</div>
<script type="text/javascript">
	$('#downExcel').click(function(){
		getTable("<?php echo U('chartSession');?>");
	});
</script>
	</div>
</div>
</body>
</html>