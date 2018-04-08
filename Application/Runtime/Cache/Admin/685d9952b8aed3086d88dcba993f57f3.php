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
		<link href="http://cdn.bootcss.com/bootstrap-switch/3.3.2/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">
<script src="http://cdn.bootcss.com/bootstrap-switch/3.3.2/js/bootstrap-switch.min.js"></script>
<style type="text/css">
	#lunch{margin: 20px;}
	#dinner{margin: 20px;}
	#black{height: 20px;}
</style>
<h2>日常管理 <small>就餐统计</small></h2>
<ul class="nav nav-tabs">
	<li role="presentation"><a href="<?php echo U('index');?>">查看统计</a></li>
	<li role="presentation" class="active"><a href="<?php echo U('fix');?>">管理设置</a></li>
</ul>
<div id="lunch">
		<h3>午餐</h3>
	<hr />
	<div class="pull-right">
		<input type="checkbox" name="lunchswitch" checked>
	</div>
	<h4>是否开启午餐</h4>
	<hr />
	<div id="islunch">
		<div class="pull-right">
			<input type="checkbox" name="lunchautoswitch" checked>
		</div>
		<h4>是否自动开启午餐</h4>
		<hr />
		<div id="islunchauto">
			<div class="form-inline pull-right">
				<div class="form-group">
					<select name="startlunchhour" id="startlunchhour" class="form-control">
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
					</select>
					<label for="startlunchhour">小时</label>
				</div>
				<div class="form-group">
					<select name="startlunchminute" id="startlunchminute" class="form-control">
						<option value="00">00</option>
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="30">30</option>
						<option value="40">40</option>
						<option value="50">50</option>
					</select>
					<label for="startminute">分钟</label>
				</div>
				<div class="form-group">
					<input type="button" id="startlunchbtn"  value="确定" class="btn btn-default" />
				</div>
			</div>
			<h4>设置午餐统计开始时间</h4>
			<hr />
			<div class="form-inline pull-right">
				<div class="form-group">
					<select name="stoplunchhour" id="stoplunchhour" class="form-control">
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
					</select>
					<label for="stoplunchhour">小时</label>
				</div>
				<div class="form-group">
					<select name="stoplunchminute" id="stoplunchminute" class="form-control">
						<option value="00">00</option>
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="30">30</option>
						<option value="40">40</option>
						<option value="50">50</option>
					</select>
					<label for="stoplunchminute">分钟</label>
				</div>
				<div class="form-group">
					<input type="button" id="stoplunchbtn" value="确定" class="btn btn-default" />
				</div>
			</div>
			<h4>设置午餐统计结束时间</h4>
			<hr />
		</div>
	</div>
		
</div>
<div id="black"></div>
<div id="dinner">
		<h3>晚餐</h3>
	<hr />
	<div class="pull-right">
		<input type="checkbox" name="dinnerswitch" checked>
	</div>
	<h4>是否开启晚餐</h4>
	<hr />
	<div id="isdinner">
		<div class="pull-right">
			<input type="checkbox" name="dinnerautoswitch" checked>
		</div>
		<h4>是否自动开启晚餐</h4>
		<hr />
		<div id="isdinnerauto">
			<div class="form-inline pull-right">
				<div class="form-group">
					<select name="startdinnerhour" id="startdinnerhour" class="form-control">
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
					</select>
					<label for="startdinnerhour">小时</label>
				</div>
				<div class="form-group">
					<select name="startdinnerminute" id="startdinnerminute" class="form-control">
						<option value="00">00</option>
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="30">30</option>
						<option value="40">40</option>
						<option value="50">50</option>
					</select>
					<label for="startdinnerminute">分钟</label>
				</div>
				<div class="form-group">
					<input type="button" id="startdinnerbtn" value="确定" class="btn btn-default" />
				</div>
			</div>
			<h4>设置晚餐统计开始时间</h4>
			<hr />
			<div class="form-inline pull-right">
				<div class="form-group">
					<select name="stopdinnerhour" id="stopdinnerhour" class="form-control">
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
					</select>
					<label for="stophour">小时</label>
				</div>
				<div class="form-group">
					<select name="stopdinnerminute" id="stopdinnerminute" class="form-control">
						<option value="00">00</option>
						<option value="10">10</option>
						<option value="20">20</option>
						<option value="30">30</option>
						<option value="40">40</option>
						<option value="50">50</option>
					</select>
					<label for="stopdinnerminute">分钟</label>
				</div>
				<div class="form-group">
					<input type="button" id="stopdinnerbtn" value="确定" class="btn btn-default" />
				</div>
			</div>
			<h4>设置晚餐统计结束时间</h4>
			<hr />
		</div>
	</div>
		
</div>
<script type="text/javascript">
	$("[name='lunchswitch']").bootstrapSwitch();
	$("[name='lunchautoswitch']").bootstrapSwitch();
	$("[name='dinnerswitch']").bootstrapSwitch();
	$("[name='dinnerautoswitch']").bootstrapSwitch();
	
	$('input[name="lunchswitch"]').on('switchChange.bootstrapSwitch', function(event, state) {
		layer.msg(state); // true | false
	});
</script>
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