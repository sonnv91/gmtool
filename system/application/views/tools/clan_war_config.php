<section class="content-header">
    <h1><?php echo $title; ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12" id="content-config">
			<form class="form-horizontal" action="<?php echo base_url();?>data/clan_war" method="post">
                <div class="box">
					<h3>Thời gian kết thúc đấu thầu</h3>
                        <div class="form-group">
                            <label class="col-sm-2">Ngày</label>
                            <select name="time_end_bid[]" class="selectpicker" data-live-search="true">
								<option value="1" <?php if($timeEndBidding[0] == 1){ echo "selected";}?>>T2</option>
								<option value="2" <?php if($timeEndBidding[0] == 2){ echo "selected";}?>>T3</option>
								<option value="3" <?php if($timeEndBidding[0] == 3){ echo "selected";}?>>T4</option>
								<option value="4" <?php if($timeEndBidding[0] == 4){ echo "selected";}?>>T5</option>
								<option value="5" <?php if($timeEndBidding[0] == 5){ echo "selected";}?>>T6</option>
								<option value="6" <?php if($timeEndBidding[0] == 6){ echo "selected";}?>>T7</option>
								<option value="7" <?php if($timeEndBidding[0] == 7){ echo "selected";}?>>CN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputMapName" class="col-sm-2">Giờ</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="time_end_bid[]" value="<?php echo $timeEndBidding[1];?>"/>
                            </div>
							<div class="col-sm-1">
								<input type="number" class="form-control" name="time_end_bid[]" value="<?php echo $timeEndBidding[2];?>"/>
							</div>
                        </div>
                </div>
				<div class="box">
					<h3>Thời gian bắt đầu chiến đấu</h3>
                        <div class="form-group">
                            <label class="col-sm-2">Ngày</label>
                            <select name="time_start_war[]" class="selectpicker" data-live-search="true">
								<option value="1" <?php if($timeStartWar[0] == 1){ echo "selected";}?>>T2</option>
								<option value="2" <?php if($timeStartWar[0] == 2){ echo "selected";}?>>T3</option>
								<option value="3" <?php if($timeStartWar[0] == 3){ echo "selected";}?>>T4</option>
								<option value="4" <?php if($timeStartWar[0] == 4){ echo "selected";}?>>T5</option>
								<option value="5" <?php if($timeStartWar[0] == 5){ echo "selected";}?>>T6</option>
								<option value="6" <?php if($timeStartWar[0] == 6){ echo "selected";}?>>T7</option>
								<option value="7" <?php if($timeStartWar[0] == 7){ echo "selected";}?>>CN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputMapName" class="col-sm-2">Giờ</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="time_start_war[]" value="<?php echo $timeStartWar[1];?>"/>
                            </div>
							<div class="col-sm-1">
								<input type="number" class="form-control" name="time_start_war[]" value="<?php echo $timeStartWar[2];?>"/>
							</div>
                        </div>
						<div class="form-group">
                            <label for="inputMapName" class="col-sm-2">Thời gian chiến đấu (min)</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="timeBattle" value="<?php echo $config->durationWarClan;?>"/>
                            </div>
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