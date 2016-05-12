<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"><!-- ie兼容 -->
	<meta charset="UTF-8">
	<title>web相册管理</title>
	<link href="/albumO/src/Public/css/bootstrap.min.css" rel="stylesheet">
  	<link href="/albumO/src/Public/css/sweetalert.css" rel="stylesheet">
	<link href="/albumO/src/Public/admin/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-default" style="margin-bottom: 0;border-radius: 0;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo U('Home/Index/index');?>">
      	<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a>相册管理</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(session('?name')): ?><li><a>欢迎您：<?php echo (session('name')); ?></a></li>
          <li><a href="<?php echo U('Home/Index/index');?>">前台</a></li><?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<h1>相册管理，图片管理，人员管理</h1>
<h2>汪乐：
admin.html,
left.css,
left.js
</h2>
<p>任务：做一个侧边管理
描述：在后台左侧做一个导航，链接ａ空着不写，页面绘制出来即可
说明：ｃｓｓ加前缀ｗａｎｇ，ｊｓ注意封装，使用面向对象，只修改指定的３个文件
要求：边写的ｃｓｓ，ｊｓ具有一定的可移植性：即容易迁移到其他地方</p>

	<script src="/albumO/src/Public/js/jquery.min.js"></script>
	<script src="/albumO/src/Public/js/bootstrap.min.js"></script>
	<script src="/albumO/src/Public/admin/style.js"></script>
	</body>
</html>