<section class="content-header">
    <h1><?php echo $title; ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12" id="content-config">
            <?php $i = 0;foreach ($config as $conf) { ?>
                <div class="box">
                    <form class="form-horizontal" action="<?php echo base_url();?>data/event_groupon/save" method="post">
                        <input type="hidden" name="id" value="<?php echo $conf->id;?>">
						<h3><?php echo $conf->id;?></h3>
                        <div class="form-group">
                            <label class="col-sm-2">Nguyên liệu</label>
                            <select name="item" class="selectpicker" data-live-search="true">
                                <?php foreach ($items as $item) { ?>
                                    <option value="<?php echo $item->id."-".$item->docType; ?>" <?php if ($conf->item->parent == $item->id) {echo 'selected="selected"';} ?>><?php echo $item->name; ?></option>
                                <?php } ?>
                                <?php foreach ($staticItems as $static) { ?>
                                    <option value="<?php echo $static->id."-".$static->doc_type; ?>" <?php if ($conf->item->id == $static->id) {echo 'selected="selected"';} ?>><?php echo $static->name; ?> (s)</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputMapName" class="col-sm-2">Số lượng</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="quantity" value="<?php echo $conf->item->quantity;?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputMapName" class="col-sm-2">Mốc người mua giảm giá</label>
                            <div class="col-sm-1">
                                <input type="number" name="term[]" value="<?php echo $conf->term[0];?>" class="form-control"/>
                            </div>
                            <div class="col-sm-1">
                                <input type="number" name="term[]" value="<?php echo $conf->term[1];?>" class="form-control"/>
                            </div>
                            <div class="col-sm-1">
                                <input type="number" name="term[]" value="<?php echo $conf->term[2];?>" class="form-control"/>
                            </div>
                            <div class="col-sm-1">
                                <input type="number" name="term[]" value="<?php echo $conf->term[3];?>" class="form-control"/>
                            </div>
                            <div class="col-sm-1">
                                <input type="number" name="term[]" value="<?php echo $conf->term[4];?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputMapName" class="col-sm-2">% giảm</label>
                            <div class="col-sm-1">
                                <input type="number" name="discount[]" value="<?php echo $conf->discount[0];?>" class="form-control"/>
                            </div>
                            <div class="col-sm-1">
                                <input type="number" name="discount[]" value="<?php echo $conf->discount[1];?>" class="form-control"/>
                            </div>
                            <div class="col-sm-1">
                                <input type="number" name="discount[]" value="<?php echo $conf->discount[2];?>" class="form-control"/>
                            </div>
                            <div class="col-sm-1">
                                <input type="number" name="discount[]" value="<?php echo $conf->discount[3];?>" class="form-control"/>
                            </div>
                            <div class="col-sm-1">
                                <input type="number" name="discount[]" value="<?php echo $conf->discount[4];?>" class="form-control"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputMapName" class="col-sm-2">Giá gốc</label>
                            <div class="col-sm-1">
                                <input type="number" class="form-control" name="price" value="<?php echo $conf->price; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="button" class="btn btn-danger" value="Xóa" id="remove-config">
                                <button id="save-btn" type="button" class="btn btn-primary" data-loading-text="Loading...">Lưu lại</button>
                            </div>
                        </div>
                    </form>
                </div>
                <?php $i++;} ?>
        </div>
        <div class="form-group">
            <div class="input-group">
                <button type="button" class="btn btn-success" id="add-config">Thêm vật phẩm</button>
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
<script>

    $(document).on("click", "#remove-config", function () {
        var id = $(this).closest('form').find('input[name="id"]').val();
        if(id != ""){
            if(confirm('Bạn có chắc muốn xóa?')){
                $(this).closest('div.box').remove();
                $.ajax({
                    url : '<?php echo base_url()."data/cache/delete";?>',
                    type: "POST",
                    data : {
                        id : id,
                        doc_type : 'PRODUCT_GROUPON'
                    },
                    success:function(data, textStatus, jqXHR)
                    {
                        alert('Xóa thành công!');
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        alert(textStatus);//if fails
                    }
                });
            }
        }else{
            $(this).closest('div.box').remove();
        }
    });

    $(document).on("click", "#add-config", function () {
        var contentConfig = $("div#content-config")
        var clone = $("div.box:last").clone()
        clone.find('input[name="id"]').attr("value","")
        clone.find("div.bootstrap-select:last").remove()
        contentConfig.append(clone)
        $('.selectpicker').selectpicker("refresh");

    });

    $(document).on("change", "select[name^='materials']", function () {
        var form_group = $(this).closest("div.form-group").next().find(".col-sm-10");
        var select = $(this);
        var index = form_group.attr("index");

        form_group.find(".input-group").each(function () {
            if (select.val() == null) {
                form_group.empty();
            } else {
                if (select.val().indexOf($(this).attr("id")) < 0) {
                    $(this).remove()
                }
            }
        });
        var total = select.val().length;
        for (var i = 0; i < total; i++) {
            var val = select.val()[i]
            if (form_group.find("div#" + val).length < 1) {
                var input_group = $("div.input-group[id='clone']").clone()
                input_group.removeAttr("style")
                input_group.removeAttr("id")
                input_group.attr("id", val)
                input_group.find("span").html(select.find("option[value='" + val + "']").html())
                input_group.find("input").attr("name", "quantity-" + index + "-" + val)
                input_group.find("input").val(1)
                form_group.append(input_group)
            }
        }
    });
</script>