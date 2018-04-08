<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title><?php echo ($formhead); if(empty($prompt)): ?>提交成功<?php else: echo ($prompt); endif; ?></title>
		<!--main开始-->
<link rel='stylesheet' href='http://apps.bdimg.com/libs/bootstrap/3.3.4/css/bootstrap.min.css'>
<link rel="stylesheet" type="text/css" href="/trainer/Public/css/home.css"/>
<script src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js" type="text/javascript" charset="utf-8"></script>
<!--main结束-->
		<style type="text/css">
			.btn{width: auto; background-color: #FFFFFF; color: #808080;border-color: #DDDDDD;padding: 2px 8px;}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-3 col-md-4"></div>
				<div class="col-sm-6 col-md-4 body-center">
					<h3 class="title text-center">
						<?php echo ($formhead); ?>
					</h3>
					<div class="content">
						<?php if($error == 1): ?><div class="error-icon text-center">
								<span class="glyphicon glyphicon-ban-circle icon-lg"></span>
								<h4><?php if(empty($prompt)): ?>提交失败<?php else: echo ($prompt); endif; ?></h4>
								<?php if(!empty($msg)): ?><div class="well">
										<?php echo ($msg); ?>
									</div><?php endif; ?>
							</div>
							<?php else: ?>
							<div class="success-icon text-center">
								<span class="glyphicon glyphicon-ok-circle icon-lg"></span>
								<h4><?php if(empty($prompt)): ?>提交成功<?php else: echo ($prompt); endif; ?></h4>
							</div><?php endif; ?>
						<!--<div class="guidebtn">
							<button class="btn btn-primary">填写发票</button>
							<span style="margin-left: 30px;"></span>
							<button class="btn btn-primary">关闭本页</button>
						</div>-->
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
	</body>
</html>