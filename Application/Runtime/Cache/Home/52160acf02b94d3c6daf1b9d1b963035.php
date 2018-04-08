<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo ($title); ?></title>
		<!--main开始-->
<link rel='stylesheet' href='http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css'>
<link rel="stylesheet" type="text/css" href="/trainer/Public/css/home.css"/>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<!--main结束-->
		<style type="text/css">
			.listContent{color: #FFFFFF;margin-top: 12px; padding: 8px;background-color: #33CC99;cursor: pointer; }
			.detailsPanel{color: #FFFFFF; display: none;background-color: #33CC99;}
		</style>
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
						<?php if(!empty($introduce)): ?><div id="introduce">
								<p class="help-block">
									<?php echo ($introduce); ?>
								</p>
								<hr class="text-center" />
							</div><?php endif; ?>
						<div id="resultList">
							<?php if(is_array($formReturn)): foreach($formReturn as $key=>$user): ?><div class="listContent" data-listId = "<?php echo ($user["id"]); ?>">
									<h4><?php echo ($user["username"]); ?></h4>
									<span class="pull-right"><?php echo ($user["time"]); ?></span>
									<span><?php echo ($user["companyname"]); ?></span>
								</div>
								<div class="detailsPanel" id='detail<?php echo ($user["id"]); ?>'>
									<table class="table">
										<tr><th>性别</th><td><?php echo ($user["usersex"]); ?></td></tr>
										<tr><th>电话</th><td><?php echo ($user["usertel"]); ?></td></tr>
										<tr><th>岗位</th><td><?php echo ($user["userstation"]); ?></td></tr>
										<tr><th>职称</th><td><?php echo ($user["userjob"]); ?></td></tr>
										<tr><th>单住</th><td><?php echo ($user["userroom"]); ?></td></tr>
									</table>
								</div><?php endforeach; endif; ?>
						</div>
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
<script src="/trainer/Public/js/homeFooter.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$('.listContent').click(function(){
				$('#detail' + this.getAttribute('data-listId')).slideToggle('slow');
				setTimeout('position()',800); //定位footer函数
			});
		</script>
	</body>
</html>