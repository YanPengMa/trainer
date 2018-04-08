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
						<li><a href="<?php echo U('Login/unsetLogin');?>"><i class="glyphicon glyphicon-log-out"></i> 退出登录</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
	<div id="page-wrapper">
		<h2>报名管理 <small>报名管理</small></h2>
<div class="pull-right">
	<span id="downExcel" class="btn btn-default"><span  class="glyphicon glyphicon-cloud-download"></span> Excel</span>
</div>
<div class="form-inline">
	<div class="form-group">
		<label for="userstatus">用户状态</label>
		<select id="userstatus" name="userstatus" class="form-control">
			<option value="1">正常</option>
			<option value="all">全部</option>
			<option value="0">已删除</option>
		</select>
	</div>
	<div class="form-group">
		<input type="button" id="submit" class="btn btn-default" value="查询" />
	</div>
</div>

<div class="table-responsive">
	<table class="table table-bordered table-hover">
		<tr><th>姓名</th><th>单位名称</th><th>性别</th><th>电话</th><th>岗位名称</th><th>职称</th><th>是否单住</th><th>所在班级</th><th>操作</th></tr>
		<?php if(is_array($user)): foreach($user as $key=>$data): ?><tr><td><?php echo ($data['username']); ?></td><td><?php echo ($data['companyname']); ?></td><td><?php echo ($data['usersex']); ?></td><td><?php echo ($data['usertel']); ?></td><td><?php echo ($data['userstation']); ?></td><td><?php echo ($data['userjob']); ?></td><td><?php echo ($data['userroom']); ?></td><td><?php echo ($data['classname']); ?><span data-id="<?php echo ($data['id']); ?>" data-classId="<?php echo ($data['classid']); ?>" onclick="getClass(this)" title="设置分组" class="badge primary"><span class="glyphicon glyphicon-edit"></span></span></td><td><!--<span class="badge primary">修改</span>--><?php if($data['userstatus'] == 1): ?><span data-id = "<?php echo ($data['id']); ?>" onclick="unsetuser(this)" title="删除" class="badge danger">删除</span><?php else: ?><span data-id = "<?php echo ($data['id']); ?>" onclick="recoveruser(this)" title="恢复" class="badge warning">恢复</span><?php endif; ?></td></tr><?php endforeach; endif; ?>
	</table>
</div>
<script type="text/javascript">
	$('#downExcel').click(function(){
		getTable("<?php echo U('exportuser',array('data'=>'str'));?>");
	});
	$('#submit').click(function(){
		var userstatus = document.getElementById("userstatus");
		var selectstatus = userstatus.options[userstatus.selectedIndex].value;
		var selecturl = "<?php echo U('index',array('userstatus'=>'data'));?>";
		selecturl = selecturl.replace('data',selectstatus);
		window.location.href = selecturl;
//		$.get(selecturl,{userstatus:selectstatus},function(){
//			location.reload();
//		});
	});
	function getClass(obj){
		var id = obj.getAttribute('data-id');
		var classId = obj.getAttribute('data-classId');
		$.post("<?php echo U('getClass');?>",{},function(data){
			//页面层
			layer.open({
				type: 0,
				title:'修改所在班级',
				skin: 'layui-layer-rim', //加上边框
				content: data,
				btn: ['确认','取消'],
				yes: function(){
					var classname = document.getElementById('classname');
					var selectClassIndex = classname.options[classname.selectedIndex].value;
					if(selectClassIndex == classId){
						layer.msg('未做修改');
					}else{
						fixClass(id,selectClassIndex);
					}
//					layer.msg(selectClassIndex);
				}
			});
		});
	}
	function fixClass(id,selectClassIndex){
		$.post("<?php echo U('fixClass');?>",{id:id,selectClassIndex:selectClassIndex},function(data){
			layer.msg(data.msg);
			if(data.error == 0){
				location.reload();
			}
		},'json');
	}
	function unsetuser(obj){
		var id = obj.getAttribute('data-id');
		//询问框
		layer.confirm('确定要删除该同学信息？', {
			btn: ['确定','取消']  //按钮
		}, function(){
			$.post("<?php echo U('unsetuser');?>",{id:id},function(data){
				layer.msg(data.msg);
				if(data.error == 0){
					location.reload();
				}
			},'json');
		});
		
	}
	function recoveruser(obj){
		var id = obj.getAttribute('data-id');
		//询问框
		layer.confirm('确定要恢复该同学信息？', {
			btn: ['确定','取消']  //按钮
		}, function(){
			$.post("<?php echo U('recoveruser');?>",{id:id},function(data){
				layer.msg(data.msg);
				if(data.error == 0){
					location.reload();
				}
			},'json');
		});
	}
//	function fix(obj){
//		var id = obj.getAttribute('data-id');
//		var data = <?php echo ($data); ?>;
//		//设置索引
//		var index = 0;
//		//找data-id的父级索引
//		for(var i = 0;i<data.length; i++){
//			if(data[i].id == id){index = i; break;}
//		}
//		//生成页面层的html
//		var dataArray = Array(
//			'username' => data[index].username,
//			'companyname' => data[index].companyname,
//			'usersex' => data[index].usersex,
//			'usertel' => data[index].usertel,
//			'usersatation' => data[index].userstation,
//			'userjob' => data[index].userjob
//		);
//		$.post("<?php echo U('fix');?>",data:JSON.stringify(dataArray),function(data){
//			var contentHtml = data;
//		},'json');
//		//页面层
//		layer.open({
//			type: 0,
//			skin: 'layui-layer-rim', //加上边框
//			content: contentHtml
//		});
//	}
	
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