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
                        <label>Range Time</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <select name="range" class="form-control">
								<option value="1" <?php if($range == 1){echo "selected";}?>>1</option>
								<option value="3" <?php if($range == 3){echo "selected";}?>>3</option>
								<option value="7" <?php if($range == 7){echo "selected";}?>>7</option>
								<option value="30" <?php if($range == 30){echo "selected";}?>>30</option>
								<option value="60" <?php if($range == 60){echo "selected";}?>>60</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group">
						<label>Date:</label>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input id="datemask" type="text" name="date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" value="<?php echo $date;?>">
						</div>
						<button class="button">Xem</button>
					</div>
                </form>
            </div>
        </div>
    </div>
    <div id="container" style="height: 400px; min-width: 310px"></div>
</section>
<script src="<?php echo base_url();?>public/temp/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!-- jQuery UI 1.11.2 -->
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url();?>public/temp/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/chart/highcharts/highcharts.js"></script>
<script src="<?php echo base_url();?>public/chart/highcharts/modules/exporting.js"></script>
<script src="<?php echo base_url();?>public/temp/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>public/temp/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>public/temp/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script>
    $(function () {
	$("input[id^='datemask']").inputmask("date");
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: '<?php echo $title;?>'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Retention Rate',
            colorByPoint: true,
            data: <?php echo $chartData;?>
        }]
    });
});

</script>
<script src="<?php echo base_url();?>public/temp/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo base_url();?>public/temp/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url();?>public/temp/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo base_url();?>public/temp/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>public/temp/dist/js/app.min.js" type="text/javascript"></script>