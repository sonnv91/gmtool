<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login - GMTool AutoVL</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url();?>public/temp/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="<?php echo base_url();?>public/temp/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>GMTool</b>AutoVL</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <form action="<?php echo base_url();?>user/login" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="username" class="form-control" placeholder="Username"/>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <select name="server_remote" class="form-control">
                    <option value="dev">Dev</option>
                    <option value="vl">Release</option>
                    <option value="en">English</option>
                </select>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <input type="button" id="btn-login" class="btn btn-primary btn-block btn-flat" value="Đăng nhập">
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<script src="<?php echo base_url();?>public/temp/js/jquery-1.11.0.min.js"></script>
<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url();?>public/temp/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="<?php echo base_url();?>public/temp/js/main.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url();?>public/temp/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>