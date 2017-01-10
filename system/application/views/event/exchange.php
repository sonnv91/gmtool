<section class="content-header">
    <h1><?php echo $title; ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Phần thưởng</a></li>
                        <li role="presentation"><a href="#items" aria-controls="items" role="tab" data-toggle="tab">Vật phẩm đổi</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <form action="<?php echo base_url(); ?>data/event_exchange/save" method="post" role="form">
                    <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="info">
                                <!--<div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Gói nguyên liệu sự kiện</label>
                                    <div class="col-sm-10">
                                        <select name="drop_item" class="selectpicker" data-live-search="true">
                                            <?php //foreach ($rewards as $reward) { ?>
                                                <option value="<?php //echo $reward->id; ?>" <?php //if ($reward->id == $config->dropItem) {echo 'selected="selected"';} ?>><?php //echo $reward->name; ?></option>
                                            <?php //} ?>
                                        </select>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tiêu đề sự kiện</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" value="<?php echo $config->title; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Top 1 Event</label>
                                    <div class="col-sm-10">
                                        <select name="reward_top_event[]" class="selectpicker" data-live-search="true">
                                            <?php foreach ($rewards as $reward) { ?>
                                                <option value="<?php echo $reward->id; ?>" <?php if ($reward->id == $config->rewardTopEvent[0]) {echo 'selected="selected"';}?>><?php echo $reward->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Top 2 Event</label>
                                    <div class="col-sm-10">
                                        <select name="reward_top_event[]" class="selectpicker" data-live-search="true">
                                            <?php foreach ($rewards as $reward) { ?>
                                                <option value="<?php echo $reward->id; ?>" <?php if ($reward->id == $config->rewardTopEvent[1]) { echo 'selected="selected"';} ?>><?php echo $reward->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Top 3 Event</label>
                                    <div class="col-sm-10">
                                        <select name="reward_top_event[]" class="selectpicker" data-live-search="true">
                                            <?php foreach ($rewards as $reward) { ?>
                                                <option value="<?php echo $reward->id; ?>" <?php if ($reward->id == $config->rewardTopEvent[2]) { echo 'selected="selected"';} ?>><?php echo $reward->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Điểm tối thiểu đạt top</label>
                                    <div class="col-sm-1">
                                        <input type="number" name="min_point_top_reward" class="form-control" value="<?php echo $config->minPointTopReward; ?>">
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="items">
                                <?php $i=0; foreach($config->itemExchanges as $itemExchange){?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-sm-2">Nguyên liệu</label>
                                            <select name="materials-<?php echo $i;?>[]" class="selectpicker" data-live-search="true" multiple>
                                                <?php foreach ($materials as $key => $value) { ?>
                                                    <option value="<?php echo $key; ?>" <?php if(in_array($key, $itemExchange->materials)){echo 'selected="selected"';}?>><?php echo $value; ?></option>
                                                <?php } ?>
												<?php foreach ($usableItems as $key => $value) { ?>
                                                    <option value="<?php echo $key; ?>" <?php if(in_array($key, $itemExchange->materials)){echo 'selected="selected"';}?>><?php echo $value; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputMapName" class="col-sm-2 control-label">Số lượng</label>
                                            <div class="col-sm-10" index="<?php echo $i;?>">
                                                <?php $j=0;foreach($itemExchange->materials as $m){ ?>
                                                    <div class="input-group" id="<?php echo $m;?>">
                                                        <span class="input-group-addon"><?php echo isset($materials[$m]) ? $materials[$m] :  $usableItems[$m];?></span>
                                                        <input type="text" class="form-control col-sm-2" name="quantity-<?php echo $i;?>-<?php echo $m;?>" value="<?php echo $itemExchange->quantity[$j];?>">
                                                    </div>
                                                <?php $j++;}?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="col-sm-2">Nhận</label>
                                            <select name="item-<?php echo $i;?>" class="selectpicker" data-live-search="true">
                                                <?php foreach ($usableItems2 as $usableItem) { ?>
                                                    <option value="<?php echo $usableItem->id; ?>" <?php if($itemExchange->item == $usableItem->id){echo 'selected="selected"';}?>><?php echo $usableItem->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputMapName" class="col-sm-2 control-label">Điểm</label>
                                            <div class="col-sm-2">
                                                <input type="number" class="form-control col-sm-2" name="point[]" value="<?php echo $itemExchange->point;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group">
                                            <input type="button" class="btn-danger" value="Xóa" id="remove-config">
                                        </div>
                                    </div>
                                </div><hr/>
                                <?php $i++;}?>
                            </div>
                            <div class="modal-footer">
                                <button id="add-config" type="button" class="btn btn-default">Thêm vật phẩm đổi</button>
                                <button id="save-btn" type="button" class="btn btn-primary" data-loading-text="Loading...">Lưu lại</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="row" id="clone-config" style="display: none">
    <div class="col-md-6">
        <div class="form-group">
            <label class="col-sm-2">Nguyên liệu</label>
            <select name="materials-" data-live-search="true" multiple>
                <?php foreach ($materials as $key => $value) { ?>
                    <option value="<?php echo $key; ?>"?><?php echo $value; ?></option>
                <?php } ?>
				<?php foreach ($usableItems as $key => $value) { ?>
					<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
				<?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="inputMapName" class="col-sm-2 control-label">Số lượng</label>
            <div class="col-sm-10" index="0">

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="col-sm-2">Nhận</label>
            <select name="item-" data-live-search="true">
                <?php foreach ($usableItems2 as $usableItem) { ?>
                    <option value="<?php echo $usableItem->id; ?>"><?php echo $usableItem->name; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="inputMapName" class="col-sm-2 control-label">Điểm</label>
            <div class="col-sm-2">
                <input type="number" class="form-control col-sm-2" name="point[]" value="1">
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group">
            <input type="button" class="btn-danger" value="Xóa" id="remove-config">
        </div>
    </div>
</div>
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
<script>

    $(document).on("click", "#remove-config", function(){
        $(this).closest("div.row").next("hr").remove();
        $(this).closest("div.row").remove();
    });

    $(document).on("click", "#add-config", function(){
        var index = $("select[name^='materials']").length - 1
        var area = $("div#items")
        var clone = $("div#clone-config").clone()

        clone.removeAttr("style")
        clone.removeAttr("id")
        clone.find("select").addClass("selectpicker")
        clone.find("select[name^='materials']").attr("name", "materials-"+index+"[]")
        clone.find("select[name^='item']").attr("name", "item-"+index)
        clone.find("div[index=0]").attr("index", index)

        area.append(clone)
        area.append("<hr/>")

        $('.selectpicker').selectpicker("refresh");

    });

    $(document).on("change", "select[name^='materials']", function(){
        var form_group = $(this).closest("div.form-group").next().find(".col-sm-10");
        var select = $(this);
        var index = form_group.attr("index");

        form_group.find(".input-group").each(function(){
            if(select.val() == null){
                form_group.empty();
            }else{
                if(select.val().indexOf($(this).attr("id")) < 0){
                    $(this).remove()
                }
            }
        });
        var total = select.val().length;
        for(var i = 0; i < total; i++){
            var val = select.val()[i]
            if(form_group.find("div#"+val).length < 1){
                var input_group = $("div.input-group[id='clone']").clone()
                input_group.removeAttr("style")
                input_group.removeAttr("id")
                input_group.attr("id",val)
                input_group.find("span").html(select.find("option[value='"+val+"']").html())
                input_group.find("input").attr("name","quantity-"+index+"-"+val)
                input_group.find("input").val(1)
                form_group.append(input_group)
            }
        }
    });
</script>