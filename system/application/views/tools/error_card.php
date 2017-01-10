<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin</h3>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo base_url();?>tools/error_card">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mệnh giá</label>

                            <div class="col-sm-10">
                                <select name="amount" class="form-control">
                                    <?php foreach($this->config->item("PAYMENT_AMOUNT") as $amount){?>
                                    <option value="<?php echo $amount;?>"><?php echo $amount;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Loại nạp</label>

                            <div class="col-sm-10">
                                <select name="type" class="form-control">
                                    <option value="PAYMENT_MONTHLY">Thẻ tháng</option>
                                    <option value="PAYMENT_NORMAL">Thẻ thường</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="text" name="uid" class="form-control" id="inputPassword3" placeholder="uid">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mệnh giá</label>

                            <div class="col-sm-10">
                                <select name="server" class="form-control">
                                    <?php foreach($serverList as $server){?>
                                        <option value="<?php echo $server->code;?>"><?php echo $server->code." - ".$server->name;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input name="firstPayment" type="checkbox"> Nạp lần đầu
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-left">Submit</button>
                        <button type="button" class="btn btn-default">Cancel</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url();?>public/temp/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<!-- daterangepicker -->
<script src="<?php echo base_url();?>public/temp/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo base_url();?>public/temp/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url();?>public/temp/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo base_url();?>public/temp/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>public/temp/dist/js/app.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/temp/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/temp/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/temp/js/bootstrap-select.min.js" type="text/javascript"></script>