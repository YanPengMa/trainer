<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>西南石油大学培训中心 - 后台管理</title>
	<!--main开始-->
<link rel='stylesheet' href='http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css'>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://apps.bdimg.com/libs/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<!--main结束-->
	<link rel="stylesheet" type="text/css" href="/trainer/Public/css/local.css"/>
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
				<li><a href="<?php echo U('classmanage');?>"><i class="glyphicon glyphicon-th-list"></i> 班级管理</a></li>                    
				<li><a href="<?php echo U('index');?>"><i class="glyphicon glyphicon-level-up"></i> 报名管理</a></li>
				<li><a href="blog.html"><i class="fa fa-globe"></i> Blog</a></li>
				<li><a href="forms.html"><i class="fa fa-list-ol"></i> Forms</a></li>
				<li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
				<li><a href="bootstrap-elements.html"><i class="fa fa-list-ul"></i> Bootstrap Elements</a></li>
				<li><a href="bootstrap-grid.html"><i class="fa fa-table"></i > Bootstrap Grid</a></li>                    
			</ul>
			<ul class="nav navbar-nav navbar-right navbar-user">
				<li class="dropdown user-dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> Admin<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="glyphicon glyphicon-log-out"></i> 退出登录</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	<div id="page-wrapper">
		<h2>班级管理 <small>班级管理</small></h2>
<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<tr><th>班级名称</th><th>状态</th><th>操作</th></tr>
		<?php if(is_array($class)): foreach($class as $key=>$data): ?><tr><td><?php echo ($data["classname"]); ?></td><td><?php echo ($data["status"]); ?></td><td>&nbsp;</td></tr><?php endforeach; endif; ?>
	</table>
</div>
	</div>
</div>
</body>
</html>