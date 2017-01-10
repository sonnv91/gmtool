<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <form class="form-inline" method="post">
            <div class="form-group">
                <label for="exampleInputName2">UID</label>
                <input type="text" name="uid" class="form-control" id="exampleInputName2" placeholder="UID" value="<?php echo $uid?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail2">Server</label>
                <select class="selectpicker" name="server" data-live-search="true">
                    <?php foreach($serverList as $s){?>
                        <option value="<?php echo $s->code;?>" <?php echo ($s->code == $server) ? 'selected="selected"':'';?>><?php echo $s->code." - ".$s->name;?></option>
                    <?php }?>
                </select>
            </div>
            <button type="submit" class="btn btn-default">Search</button>
        </form>
    </div>
    <br/>
    <br/>
    <div class="row">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover" id="datatable">
                <thead>
                <tr>
                    <th>OrderId</th>
                    <th>UID</th>
                    <th>Amount</th>
                    <th>KNB</th>
                    <th>Status</th>
                    <th>Thời gian</th>
                    <th>Loại tiền</th>
                    <th>Mô tả</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($logs as $log){?>
                    <tr>
                        <td><?php echo $log->orderId;?></td>
                        <td><?php echo $log->owner;?></td>
                        <td><?php echo $log->amount;?></td>
                        <td><?php echo $log->coin;?></td>
                        <td><?php echo $log->status;?></td>
                        <td><?php echo DateUtil::formatTime($log->createTime->sec, 'd-m-Y H:i:s');?></td>
                        <td><?php echo isset($log->currency) ? $log->currency : "";?></td>
                        <td><?php echo isset($log->des) ? $log->des : "";?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
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
    $('#datatable').DataTable( );
</script>
