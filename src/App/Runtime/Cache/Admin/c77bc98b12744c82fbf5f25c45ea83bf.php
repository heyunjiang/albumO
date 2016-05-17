<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"><!-- ie兼容 -->
	<meta charset="UTF-8">
	<title>web相册管理</title>
	<link href="/albumO/src/Public/css/bootstrap.min.css" rel="stylesheet">
  <link href="/albumO/src/Public/css/sweetalert.css" rel="stylesheet">
  <link href="/albumO/src/Public/admin/style.css" rel="stylesheet">
  <script src="/albumO/src/Public/js/sweetalert.min.js"></script>
</head>
<body>
  <div id="my-nav">
    <div class="nav-head">
      <img src="/albumO/src/<?php echo ($userhead["headurl"]); ?>"><?php echo ($userhead["nickname"]); ?>
    </div>
    <div class="panel-group" id="accordion">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion"
            href="#collapseOne">
              <span class="glyphicon glyphicon-gift" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;相册管理
            </a>
          </h4>
        </div>
      <div id="collapseOne" class="panel-collapse collapse in">
        <div class="panel-body">
          <ul>
            <li><a href="<?php echo U('Admin/Admin/albumAdd');?>">相册添加</a></li>
            <li><a href="<?php echo U('Admin/Admin/album');?>">相册浏览</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion"
          href="#collapseTwo">
          <span class="glyphicon glyphicon-picture" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;图片管理
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse in">
      <div class="panel-body">
        <ul>
            <li><a href="<?php echo U('Admin/Admin/picAdd');?>">图片添加</a></li>
            <li><a href="<?php echo U('Admin/Admin/pic');?>">图片浏览</a></li>
          </ul>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion"
        href="#collapse3">
        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;用户管理
      </a>
    </h4>
  </div>
  <div id="collapse3" class="panel-collapse collapse in">
    <div class="panel-body">
      <ul> 
            <?php if(session('power') == 2): ?><li><a href="<?php echo U('Admin/Admin/userAdd');?>">用户添加</a></li><?php endif; ?>
            <li><a href="<?php echo U('Admin/Admin/user');?>">用户浏览</a></li>
          </ul>
    </div>
  </div>
</div>
</div>
</div>
<div class="my-content">
  <div class="my-content-box">
    <div class="content-head">
      <div class="head-title">web相册后台管理系统<a href="<?php echo U('Home/Index/index');?>" class="btn btn-success" style="position: absolute;right: 5%;top: 20px;">首页</a></div>
      <div class="head-des">管理相册、图片、用户</div>
    </div>
    <div class="content">




	</div>
	</div>
</div>
	<script src="/albumO/src/Public/js/jquery.min.js"></script>
	<script src="/albumO/src/Public/js/bootstrap.min.js"></script>
	<script src="/albumO/src/Public/admin/style.js"></script>
	<script src="/albumO/src/Public/admin/ajaxInput.js"></script>
	</body>
</html>