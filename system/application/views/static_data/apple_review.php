<section class="content-header">
    <h1><?php echo $title; ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12" id="content-config">
                <div class="box">
                    <form class="form-horizontal" action="<?php echo base_url();?>data/apple_review/save" method="post">
                        <div class="form-group">
                            <label for="inputMapName" class="col-sm-2">Version</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="version" value="<?php echo $config->version;?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputMapName" class="col-sm-2">Giftcode</label>
                            <div class="col-sm-10">
                                <input type="checkbox" name="giftcode" <?php if($config->giftcode) echo "checked";?>/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputMapName" class="col-sm-2">Review</label>
                            <div class="col-sm-10">
                                <input type="checkbox" name="review" <?php if($config->review) echo "checked";?>/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <button id="save-btn" type="button" class="btn btn-primary" data-loading-text="Loading...">Lưu lại</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</section>

<div class="input-group" style="display: none" id="clone">
    <span class="input-group-addon"></span>
    <input type="text" class="form-control col-sm-2" name="quantity" value="1">
</div>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url(); ?>public/temp/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>public/temp/plugins/daterangepicker/daterangepicker.js"
        type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo base_url(); ?>public/temp/plugins/datepicker/bootstrap-datepicker.js"
        type="text/javascript"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url(); ?>public/temp/plugins/slimScroll/jquery.slimscroll.min.js"
        type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo base_url(); ?>public/temp/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>public/temp/dist/js/app.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/temp/plugins/datatables/jquery.dataTables.js"
        type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/temp/plugins/datatables/dataTables.bootstrap.js"
        type="text/javascript"></script>
<script src="<?php echo base_url(); ?>public/temp/js/bootstrap-select.min.js" type="text/javascript"></script>