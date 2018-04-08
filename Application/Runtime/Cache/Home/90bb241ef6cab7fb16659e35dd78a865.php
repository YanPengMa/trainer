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
						<?php if(!empty($introduce)): ?><div id="introduce">
								<p class="help-block">
									<?php echo ($introduce); ?>
								</p>
								<hr class="text-center" />
							</div><?php endif; ?>
						<div class="well">
							<b>您提交的评价为：</b><br /><br />
							<b>课程设计：</b><?php echo ($myAdvice["adviceclass"]); ?><br />
							<b>管理服务：</b><?php echo ($myAdvice["adviceservice"]); ?><br />
							<b>食宿：</b><?php echo ($myAdvice["advicedealroom"]); ?><br />
							<b>教师教学：</b><?php echo ($myAdvice["adviceteacher"]); ?><br />
							<b>建议：</b><?php if(empty($myAdvice["advicetext"])): ?>无<?php else: echo ($myAdvice["advicetext"]); endif; ?>
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
	</body>
</html>