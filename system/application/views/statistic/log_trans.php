<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
        <div class="col-xs-6">
            <div class="box">
                <form>
                    <div class="form-group">
                        <label>Gate:</label>
                        <div class="input-group">
                            <select name="gateway" class="form-control">
								<option value="GOSU" <?php if($gateway == "GOSU") echo "selected";?>>GOSU</option>
								<option value="MINHCHU" <?php if($gateway == "MINHCHU") echo "selected";?>>MINHCHU</option>
							</select>
                        </div>
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
<script src="<?php echo base_url();?>public/chart/highstock/highstock.js"></script>
<script src="<?php echo base_url();?>public/chart/highstock/modules/exporting.js"></script>
<script>
    $(function () {
        // create the chart
        $('#container').highcharts('StockChart', {
            chart: {
                alignTicks: false
            },

            rangeSelector: {
                selected: 0
            },

            series: [{
                type: 'column',
                <?php if(isset($filed_name)) echo "name: '".$filed_name."',";?>
                data: <?php echo $chartData; ?>,
				tooltip: {
                        valueDecimals: 0
                }
            }]
        });
		$('select[name="gateway"]').on('change', function(){
			var gateway = $(this).val();
			window.location.href = '<?php echo base_url();?>statistic/rev/'+gateway;
		});
    });
</script>
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