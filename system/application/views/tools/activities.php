<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-8">
            <div class="box">
                Boss Hoàng Kim
            </div>
        </div>
        <div class="col-xs-4">
            <div class="box">
                <?php //if(isset($logBossSession->createTime)){if($logBossSession->createTime->sec > time()){
                    //echo '<label>'.DateUtil::formatTime($logBossSession->createTime->sec, 'd-m-Y H:i').'</label>';
                    //echo '<input class="btn btn-primary" type="button" value="Bắt đầu" id="start-boss"/>';
                //}?>
				<input class="btn btn-primary" type="button" value="Bắt đầu" id="start-boss"/>
				<input class="btn btn-danger" type="button" value="Kết thúc" id="end-boss"/>
                <?php //if($logBossSession->createTime->sec <= time() && time() <= $logBossSession->endTime->sec) echo 'Đang diễn ra';}?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-8">
            <div class="box">
                Tống Kim
            </div>
        </div>
        <div class="col-xs-4">
            <div class="box">
                <?php //if(isset($logTongkimSession->createTime)){if(isset($logTongkimSession->createTime) && $logTongkimSession->createTime->sec > time()){
                    //echo '<label>'.DateUtil::formatTime($logTongkimSession->createTime->sec, 'd-m-Y H:i').'</label>';
                    //echo '<input class="btn btn-primary" type="button" value="Bắt đầu" id="start-tk"/>';
                //}?>
				<input class="btn btn-primary" type="button" value="Bắt đầu" id="start-tk"/>
				<input class="btn btn-danger" type="button" value="Kết thúc" id="end-tk"/>
                <?php //if($logTongkimSession->createTime->sec <= time() && time() <= $logTongkimSession->endTime->sec) echo 'Đang diễn ra';}?>
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
    $('input#start-tk').on('click', function(){
        $.ajax(
        {
            url : "<?php echo base_url();?>tools/startTongkim",
            type: "GET",
            //data : postData,
            success:function(data, textStatus, jqXHR)
            {
				alert(data);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(textStatus);//if fails
            }
        });
    });
	
	$('input#end-tk').on('click', function(){
        $.ajax(
        {
            url : "<?php echo base_url();?>tools/endTk",
            type: "GET",
            //data : postData,
            success:function(data, textStatus, jqXHR)
            {
				alert(data);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(textStatus);//if fails
            }
        });
    });
	
	$('input#start-boss').on('click', function(){
        $.ajax(
        {
            url : "<?php echo base_url();?>tools/startBossHK",
            type: "GET",
            //data : postData,
            success:function(data, textStatus, jqXHR)
            {
				alert(data);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(textStatus);//if fails
            }
        });
    });
	
	$('input#end-boss').on('click', function(){
        $.ajax(
        {
            url : "<?php echo base_url();?>tools/endBossHK",
            type: "GET",
            //data : postData,
            success:function(data, textStatus, jqXHR)
            {
				alert(data);
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(textStatus);//if fails
            }
        });
    });
</script>