<?php if (!defined('THINK_PATH')) exit();?><div class="modal fade" role="dialog" id="login">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="font-size:16px;margin-bottom:15px;">登录</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="login-form">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
            </form>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">取消</button>
                <button type="button" class="btn btn-primary">确定</button>
            </div>
        </div>
    </div>
</div> 
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"><!-- ie兼容 -->
	<meta charset="UTF-8">
	<title>header </title>
	<link href="/albumO/src/Public/css/bootstrap.min.css" rel="stylesheet">
	<link href="/albumO/src/Public/home/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-inverse" style="margin-bottom: 0;border-radius: 0;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo U('Home/Index/index');?>">
      	<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo U('Home/Index/index');?>">首页</a></li>
        <li><a href="<?php echo U('Home/Index/myalbum');?>">我的相册</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a>欢迎您：游客</a></li>
        <li><a href="#" data-toggle="modal" data-target="#login">登录</a></li>
        <li><a href="#">注册</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-12 album-box-box">
			<img src="/albumO/src/Public/img/icons/border-head1.jpg" class="album-box-border-head">
			<div class="album-box-border">
				<div class="row">
					<div class="album-box-border-leaf">
						<span class="glyphicon glyphicon-leaf" aria-hidden="true"></span>
						<span>2016.5.9</span>
					</div>
					<div class="col-xs-6 col-md-4">
						<div class="album-box">
							<img src="/albumO/src/Public/img/icons/test.png" class="pointer-cursor">
							<div class="album-box-imglength">23</div>
							<div class="album-box-content">
								<p><img src="/albumO/src/Public/img/icons/border-head1.jpg"> 何运江</p>
								<p>描述: 来最美丽的地方，我带你感受天堂来最美丽的地方，我带你感受天堂来最美丽的地方，我带你感受天堂来最美丽的地方，我带你感受天堂</p>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-4">
						<div class="album-box">
							<img src="/albumO/src/Public/img/icons/test1.png" class="pointer-cursor">
							<div class="album-box-imglength">23</div>
							<div class="album-box-content">
								<p><img src="/albumO/src/Public/img/icons/border-head.jpg"> 何运江</p>
								<p>描述: 来最美丽的地方，我带你感受天堂</p>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-4">
						<div class="album-box">
							<img src="/albumO/src/Public/img/icons/test.png" class="pointer-cursor">
							<div class="album-box-imglength">23</div>
							<div class="album-box-content">
								<p><img src="/albumO/src/Public/img/icons/border-head1.jpg"> 何运江</p>
								<p>描述: 来最美丽的地方，我带你感受天堂来最美丽的地方，我带你感受天堂来最美丽的地方，我带你感受天堂来最美丽的地方，我带你感受天堂</p>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-4">
						<div class="album-box">
							<img src="/albumO/src/Public/img/icons/test.png" class="pointer-cursor">
							<div class="album-box-imglength">23</div>
							<div class="album-box-content">
								<p><img src="/albumO/src/Public/img/icons/border-head1.jpg"> 何运江</p>
								<p>描述: 来最美丽的地方，我带你感受天堂来最美丽的地方</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="album-box-border-leaf">
						<span class="glyphicon glyphicon-leaf" aria-hidden="true"></span>
						<span>2016.5.7</span>
					</div>
					<div class="col-xs-6 col-md-4">
						<div class="album-box">
							<img src="/albumO/src/Public/img/icons/test.png" class="pointer-cursor">
							<div class="album-box-imglength">23</div>
							<div class="album-box-content">
								<p><img src="/albumO/src/Public/img/icons/border-head1.jpg"> 何运江</p>
								<p>描述: 来最美丽的地方，我带你感受天堂来最美丽的地方</p>
							</div>
						</div>
					</div>
					<div class="col-xs-6 col-md-4">
						<div class="album-box">
							<img src="/albumO/src/Public/img/icons/test.png" class="pointer-cursor">
							<div class="album-box-imglength">23</div>
							<div class="album-box-content">
								<p><img src="/albumO/src/Public/img/icons/border-head1.jpg"> 何运江</p>
								<p>描述: 来最美丽的地方，我带你感受天堂来最美丽的地方</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<script src="/albumO/src/Public/js/jquery.min.js"></script>
	<script src="/albumO/src/Public/js/bootstrap.min.js"></script>
	<script src="/albumO/src/Public/home/style.js"></script>
	</body>
</html>