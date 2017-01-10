<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-6">
            <div class="box">
                <form method="post">
                    <div class="form-group">
                        <label>Khoảng thời gian:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="reservation" name="range" value="<?php echo isset($range) ? $range : "";?>">
                            <button type="submit">Xem</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="datatable">
                        <thead>
                        <tr>
                            <th>OrderId</th>
                            <th>UserId</th>
                            <th>Mệnh giá</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total=0; foreach($logs as $log){?>
                            <tr>
                                <td><?php echo $log->orderId;?></td>
                                <td><?php echo $log->owner;?></td>
                                <td><?php echo $log->amount >= 180 ? product_price($log->amount*20000/180) : $log->amount;?></td>
                                <td><?php echo DateUtil::formatTime($log->createTime->sec, 'Y-m-d H:i:s');?></td>
                            </tr>
                        <?php 
							if($log->currency == "VND"){$total += $log->amount*20000/180;}
							// if($log->currency == "USD"){echo round($log->amount);}
						}?>
                        </tbody>
                    </table>
					<p style="color:red;font-weight:bold;font-size:18px">Tổng: <?php echo product_price($total - $total / 10);?></p>
                </div>
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
<script>
	$(function () {
        $('#reservation').daterangepicker();

        $('#datatable').DataTable( {
        "aaSorting": [[ 3, 'desc']]
		});
    });
</script>