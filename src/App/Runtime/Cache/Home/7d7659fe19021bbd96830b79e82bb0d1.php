<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge"><!-- ie兼容 -->
	<meta charset="UTF-8">
	<title>web相册</title>
	<link href="/albumO/src/Public/css/bootstrap.min.css" rel="stylesheet">
  <link href="/albumO/src/Public/css/sweetalert.css" rel="stylesheet">
	<link href="/albumO/src/Public/home/style.css" rel="stylesheet">
  <link href="/albumO/src/Public/home/photos/photo1.css" rel="stylesheet">
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
        <?php if(session('?name')): ?><li><a href="<?php echo U('Admin/Admin/admin');?>">相册管理</a></li><?php endif; ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(session('?name')): ?><li><a>欢迎您：<?php echo (session('name')); ?></a></li>
          <li><a href="<?php echo U('Home/Index/login_out');?>">注销</a></li>
        <?php else: ?>
          <li><a>欢迎您：游客</a></li>
          <li><a href="#" data-toggle="modal" data-target="#login">登录</a></li>
          <li><a href="#" data-toggle="modal" data-target="#register">注册</a></li><?php endif; ?>
        <li><a>访问量：<?php echo ($total_visit); ?></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-12 album-box-box">
			<img src="/albumO/src/Public/img/icons/border-head.jpg" class="album-box-border-head">
			<div class="album-box-border">
				<?php if(is_array($ac_info)): foreach($ac_info as $key=>$vo): if($key == 0): ?><div class="row">
							<div class="album-box-border-leaf">
								<span class="glyphicon glyphicon-leaf" aria-hidden="true"></span>
								<span><?php echo ($vo["ac_add_time"]); echo ($key); ?></span>
							</div>
					<?php elseif(($vo["ac_add_time"] != $ac_info[$key-1]['ac_add_time'])): ?>
						</div>
						<div class="row">
							<div class="album-box-border-leaf">
								<span class="glyphicon glyphicon-leaf" aria-hidden="true"></span>
								<span><?php echo ($vo["ac_add_time"]); ?></span>
							</div><?php endif; ?>
					<div class="col-xs-6 col-md-4">
						<div class="album-box">
							<a href="<?php echo U('Home/Index/photos',array('ac_id'=>$vo['ac_id']));?>"><img src="/albumO/src/<?php echo ($vo["img_url"]); ?>" class="pointer-cursor"></a>
							<div class="album-box-imglength"></div>
							<div class="album-box-content">
								<p><img src="/albumO/src/<?php echo ($vo["headurl"]); ?>"> <?php echo ($vo["nickname"]); ?></p>
								<p>相册: <span><?php echo ($vo["ac_name"]); ?></span></p>
								<p>描述: <?php echo ($vo["ac_description"]); ?></p>
							</div>
						</div>
					</div><?php endforeach; endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>
	<script src="/albumO/src/Public/js/jquery.min.js"></script>
	<script src="/albumO/src/Public/js/bootstrap.min.js"></script>
	<script src="/albumO/src/Public/js/sweetalert.min.js"></script>
	<script src="/albumO/src/Public/js/ajaxfileupload.js"></script>
	<script src="/albumO/src/Public/home/style.js"></script>
	<script src="/albumO/src/Public/home/photos/photo1.js"></script>
<div class="modal fade" role="dialog" id="login">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="font-size:16px;margin-bottom:15px;text-align: center;" class="text-primary"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>  登录</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="login-form">
                    <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" class="form-control" placeholder="Email" id="email" required="required">
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" placeholder="Password" id="password" required="required">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal" id="login-cancel">取消</button>
            <button type="submit" class="btn btn-primary" id="login-sure">确定</button>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    $("#login-sure").on('click',function(){
        $.post("/albumO/src/Home/Index/login",{
            email:$("#email").val(),
            password:$("#password").val()
        },function(data,status){
            if(data != 0){
                sweetAlert({title: "登录成功"},function(){window.location.href = "<?php echo U('Home/Index/index');?>";})
            }else{
                sweetAlert("登录失败");
            }
        });
    });
</script>
 
<div class="modal fade" role="dialog" id="register">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 style="font-size:16px;margin-bottom:15px;text-align: center;" class="text-primary"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>  注册</h3>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="register-form" method="post" action="<?php echo U('Home/Index/register');?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="register-email" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" class="form-control" placeholder="Email" id="register-email" required="required">
                      </div>
                  </div>
                  <div class="form-group">
                    <label for="register-password" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" placeholder="Password" id="register-password" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label for="register-nickname" class="col-sm-2 control-label">昵称</label>
                    <div class="col-sm-10">
                        <input type="text" name="nickname" class="form-control" placeholder="nickname" id="register-nickname">
                    </div>
                </div>
                <div class="form-group">
                    <label for="register-sex" class="col-sm-2 control-label">性别</label>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                          <input type="radio" name="sex" id="sex0" value="0" checked=""> 男
                      </label>
                      <label class="radio-inline">
                          <input type="radio" name="sex" id="sex1" value="1"> 女
                      </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="headurl" class="col-sm-2 control-label">头像</label>
                    <div class="col-sm-10">
                        <input type="file" name="headurl" class="form-control" id="headurl">
                        <span id="helpBlock" class="help-block">支持 png , jpg , jpeg 的图片，请小于2M</span>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal" id="register-cancel">取消</button>
            <button type="submit" class="btn btn-primary" id="register-sure" form="register-form">确定</button>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    //控制提示信息显示与回到首页
    !function(){
        if(<?php echo ($uploadhead); ?>){
            var text = "<?php echo ($MESSAGE_LANG["$uploadhead"]); ?>";
            sweetAlert({title: text},function(){window.location.href = "<?php echo U('Home/Index/index');?>";})
        }
    }();
</script>
 
	
	</body>
</html>