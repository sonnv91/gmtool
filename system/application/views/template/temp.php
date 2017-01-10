<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>VL Atuo Admincp</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url();?>public/temp/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url();?>public/temp/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo base_url();?>public/temp/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url();?>public/temp/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url();?>public/temp/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>public/temp/css/main.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>public/temp/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url();?>public/temp/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>public/temp/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="<?php echo base_url();?>public/temp/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <!--<link href="<?php echo base_url();?>public/temp/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />-->
    <script src="<?php echo base_url();?>public/temp/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <!--<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>-->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script src="<?php echo base_url();?>public/temp/js/main.js"></script>
</head>
<body class="skin-blue">
    <div class="wrapper">
        <?php $this->load->view("template/header"); ?>
        <?php $this->load->view("template/sidebar"); ?>
        <div class="content-wrapper">
            <?php $this->load->view($sub,$data); ?>
        </div>
        <?php $this->load->view("template/footer"); ?>
    </div>
</body>