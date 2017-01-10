<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php foreach($configs as $config){?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form action="<?php echo base_url();?>data/coin_hoard/save" method="post">
                    <div id="info">
                        <input type="hidden" name="id" value="<?php echo $config->id;?>"/>
                        <h3><?php echo $config->id;?></h3>
                        <?php for($i = 0; $i < count($config->coinRequire); $i++){ ?>
                            <div class="form-inline">
                                <div class="form-group">
                                    <label for="exampleInputName2">Mốc tích lũy</label>
                                    <input type="number" name="coin_require[]" class="form-control" id="exampleInputName2" placeholder="Mốc tích lũy" value="<?php echo $config->coinRequire[$i];?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Gói quà nhận được</label>
                                    <select name="list_reward_id[]" class="selectpicker" data-live-search="true">
                                        <?php foreach($rewards as $reward){ if($reward->type != "REWARD_MAP"){?>
                                            <option value="<?php echo $reward->id;?>" <?php if($reward->id == $config->listRewardId[$i]){ echo 'selected="selected"';}?>><?php echo $reward->name;?></option>
                                        <?php }}?>
                                    </select>
                                </div>
                                <input type="button" class="btn-danger" id="remove" value="Xóa">
                            </div>
                        <?php }?>
                    </div><br/>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default" id="add-milestone">Thêm mốc</button>
                        <button id="save-btn" type="button" class="btn btn-primary" data-loading-text="Loading...">Lưu lại</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php }?>
</section>
<div class="form-inline" style="display: none" id="clone">
    <div class="form-group">
        <label for="exampleInputName2">Mốc tích lũy</label>
        <input type="number" name="coin_require[]" class="form-control" id="exampleInputName2" placeholder="Mốc tích lũy" value="0">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail2">Gói quà nhận được</label>
        <select name="list_reward_id[]" data-live-search="true">
            <?php foreach($rewards as $reward){ if($reward->type != "REWARD_MAP"){?>
                <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
            <?php }}?>
        </select>
    </div>
    <input type="button" class="btn-danger" id="remove" value="Xóa">
</div>
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
    $(document).on('click','#add-milestone', function(){
        var clone = $("#clone").clone()
        clone.removeAttr("id")
        clone.removeAttr("style")
        clone.find("select").attr("class", "selectpicker")

        $(this).closest('form').find("#info").append(clone)
        $('.selectpicker').selectpicker("refresh")
    });
    $('.content').on('click', '#remove', function(){
        $(this).parent().remove()
    })
</script>
