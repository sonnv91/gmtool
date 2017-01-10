<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <form class="navbar-form pull-right col-lg-6" id="search-form" action="javascript:search()">
            <div class="input-group">
                <input type="text" name="search_key" class="form-control" placeholder="UID_SERVER" value="<?php echo $this->uri->segment(3) ? urldecode($this->uri->segment(3)) : "";?>">
                <span class="input-group-btn">
                    <input class="btn btn-default" type="submit" value="Tìm kiếm!"/>
                </span>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>UID_Server</th>
                    <th>Item</th>
                    <th>Loại Item</th>
                    <th>Hoạt Động</th>
                    <th>Phương thức</th>
                    <th>Thay đổi</th>
                    <th>Còn lại</th>
                    <th>Thời gian</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($logs as $log){?>
                    <tr>
                        <td><?php echo $log->owner;?></td>
                        <td><?php echo $log->name;?></td>
                        <td><?php echo $log->itemType;?></td>
                        <td><?php echo $log->action;?></td>
                        <td><?php echo $log->method;?></td>
                        <td><?php echo $log->change;?></td>
                        <td><?php echo $log->remain;?></td>
                        <td><?php echo DateUtil::formatTime($log->createTime->sec, 'd-m-Y H:i:s');?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <?php echo $pagination; ?>
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
<script>
    function search(){
        var form = $('form#search-form');
        var key = form.find('input[name="search_key"]').val() == "" ? -1 : form.find('input[name="search_key"]').val();
        window.location.href = '<?php echo base_url();?>logs/inventory/'+key+'/0';
    }
</script>