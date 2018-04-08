<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo ($title); ?></title>
		<!--main开始-->
<link rel='stylesheet' href='http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css'>
<link rel="stylesheet" type="text/css" href="/trainer/Public/css/main.css"/>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<!--main结束--><script type="text/javascript" src="/trainer/Public/validator/jquery.validator.min.js?local=zh-CN" ></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-md-4"></div>
				<div class="col-sm-6 col-md-4 body-center">
					<h3 class="title text-center">
						<?php echo ($title); ?>
					</h3>
					<div class="content">
						<p class="help-block">
							<?php echo ($notice); ?>
						</p>
						<p class="help-block">
							本次统计时间段为<font color="red"><?php echo ($startTime); ?>-<?php echo ($stopTime); ?></font>
						</p>
						<hr class="text-center" />
						<form  id="form1" action="<?php echo U('Index/test');?>" method="post">
							<div class="input-group">
								<label>姓名</label>
								<input type="text" id="q1" name="q1" data-rule='required;length(6~16)' class="form-control" value="" />
							</div>
							<div class="input-group">
								<label>电话</label>
								<input type="text" id="q2" name="q2" data-rule="required,mobile" class="form-control" value="" />
							</div>
							<div class="input-group">
								<label>时间</label>
								<input type="text" id="q3" name="q3" class="form-control" value="1月25日午饭" disabled/>
							</div>
							<div class="input-group text-center">
								<button id="btn" type="submit" class="btn btn-success">提交</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-sm-3 col-md-4"></div>
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