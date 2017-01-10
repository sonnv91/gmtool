<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <button type="button" class="btn btn-success" id="add-new" data-toggle="modal" data-target="#myModal" data-map="none">Thêm mới</button><br/>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="datatable">
                        <thead>
                        <tr>
                            <th>Phái</th>
                            <th>Thuộc tính trang bị</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($optionRates as $option){?>
                            <tr>
                                <td><?php echo $this->lang->line($option->characterClass);?></td>
                                <td><?php echo $this->lang->line($option->equipmentType);?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($option));?>">Sửa</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $option->id;?>">Xóa</button>
                                    </div>
                                </td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/rate_option/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="doc_type" value="CLAZZ_RATE_OPTION"/>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Phái</label>
                        <div class="col-sm-10">
                            <select class="form-control" style="width: 200px" name="character_class">
                                <?php foreach($this->config->item("CHARACTER_CLASS") as $char){ ?>
                                    <option value="<?php echo $char;?>"><?php echo $this->lang->line($char);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Loại trang bị</label>
                        <div class="col-sm-10">
                            <select class="form-control" style="width: 200px" name="equipment_type">
                                <?php foreach($this->config->item("EQUIPMENT") as $equipment){ ?>
                                    <option value="<?php echo $equipment;?>"><?php echo $this->lang->line($equipment);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Basic</label>
                        <div class="col-sm-10">
                            <select class="selectpicker" name="option_basic[]" multiple id="multiple-basic" data-live-search="true">
                                <?php foreach($optionBasic as $basic){?>
                                    <option value="<?php echo $basic->id;?>"><?php echo $basic->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ</label>
                        <div class="col-sm-10" id="rate_basic">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Extra</label>
                        <div class="col-sm-10">
                            <select class="selectpicker" name="option_extra[]" multiple id="multiple-extra" data-live-search="true">
                                <?php foreach($optionExtra as $extra){?>
                                    <option value="<?php echo $extra->id;?>"><?php echo $extra->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ</label>
                        <div class="col-sm-10" id="rate_extra">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Unique</label>
                        <div class="col-sm-10">
                            <select class="selectpicker" name="option_unique[]" multiple id="multiple-unique" data-live-search="true">
                                <?php foreach($optionUnique as $unique){?>
                                    <option value="<?php echo $unique->id;?>"><?php echo $unique->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ</label>
                        <div class="col-sm-10" id="rate_unique">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary" data-loading-text="Loading...">Lưu lại</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form class="form-horizontal" method="post" action="<?php echo base_url()."data/cache/delete";?>">
                <input type="hidden" name="id" value=""/>
                <input type="hidden" name="doc_type" value="CLAZZ_RATE_OPTION"/>
                <input type="hidden" name="redirect" value="<?php echo base_url()?>data/rate_option"/>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">WARNING</h4>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc muốn xóa</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="input-group" style="display: none" id="multiple-basic">
    <span class="input-group-addon"></span>
    <input type="text" class="form-control col-sm-2" name="option_basic_rate" value="0">
</div>
<div class="input-group" style="display: none" id="multiple-extra">
    <span class="input-group-addon"></span>
    <input type="text" class="form-control col-sm-2" name="option_extra_rate" value="0">
</div>
<!--<div class="input-group" style="display: none" id="multiple-3">
    <span class="input-group-addon"></span>
    <input type="text" class="form-control col-sm-2" name="option_magic_rate" value="0">
</div>-->
<div class="input-group" style="display: none" id="multiple-unique">
    <span class="input-group-addon"></span>
    <input type="text" class="form-control col-sm-2" name="option_unique_rate" value="0">
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
    $('#datatable').DataTable( {
        "aaSorting": [[ 0, 'asc']]
    });
</script>
<script>
    $(document).on("change", "select[id^='multiple']", function(){
        var form_group = $(this).closest("div.form-group").next().find(".col-sm-10");
        var select = $(this)
        var idMultiple = $(this).attr("id")
        form_group.find(".input-group").each(function(){
            if(select.val() == null){
                form_group.empty();
            }else{
                if(select.val().indexOf($(this).attr("id")) < 0){
                    $(this).next("br").remove()
                    $(this).remove()
                }
            }
        });
        var total = select.val().length;
        for(var i = 0; i < total; i++){
            var val = select.val()[i]
            if(form_group.find("div#"+val).length < 1){
                var input_group = $("div.input-group[id='"+idMultiple+"']").clone()

                input_group.find("input").each(function(){
                    $(this).attr('name', $(this).attr('name')+'_'+val)
                });

                input_group.removeAttr("style")
                input_group.removeAttr("id")
                input_group.attr("id",val)
                input_group.find("span").html(select.find("option[value='"+val+"']").html())
                //input_group.find("input").val(0)
                form_group.append(input_group)
                form_group.append("<br/>")
            }
        }
    });
    $('#myModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        if(button.data('map') != 'none'){
            var data = jQuery.parseJSON(Base64.decode(button.data('map')))
			modal.find('input[name="id"]').val(data.id);
            modal.find('select>option').removeAttr("selected");
            $('.selectpicker').selectpicker("refresh");
            modal.find('select[name=character_class]>option[value='+data.characterClass+']').attr('selected','selected');
            modal.find('select[name=equipment_type]>option[value='+data.equipmentType+']').attr('selected','selected');
            $('div[id^="rate_"]').empty();
            for(var i=0;i<data.optionRateEntities.length;i++){
                var optionType = data.optionRateEntities[i].optionType;
                var optionIds = data.optionRateEntities[i].optionIds;
                var rates = data.optionRateEntities[i].rates;
                var strOptionType = "";
                switch(optionType) {
                    case "OPTION_BASIC":
                        strOptionType = "basic";
                        break;
                    case "OPTION_EXTRA":
                        strOptionType = "extra";
                        break;
                    case "OPTION_UNIQUE":
                        strOptionType = "unique";
                        break;
                }
                //if(optionType === "OPTION_BASIC"){
                    var rate_basic = $('#rate_'+strOptionType);
					var valSelect = [];
                    for(var j=0;j<optionIds.length;j++){
                        //modal.find('select[name="option_'+strOptionType+'[]"]>option[value="'+optionIds[j]+'"]').attr("selected","selected")
						valSelect.push(optionIds[j]);
                        var input_group = $("div.input-group[id='multiple-"+strOptionType+"']").clone()
                        input_group.removeAttr("style")
                        input_group.removeAttr("id")
                        input_group.find("input").each(function(){
                            $(this).attr('name', $(this).attr('name')+'_'+optionIds[j])
                            $(this).val(rates[j])
                        });
                        input_group.attr("id",optionIds[j])
                        input_group.find("span").html($("select[name='option_"+strOptionType+"[]']>option[value='"+optionIds[j]+"']").html())
                        //input_group.find("input[name='option_"+strOptionType+"_rate_"+optionIds[j]+"']").val(rates[j])
                        rate_basic.append(input_group)
                        rate_basic.append("<br/>")
                    }
					modal.find('select[name="option_'+strOptionType+'[]"]').selectpicker('val', valSelect);
                //}
            }
			$('.selectpicker').selectpicker("refresh");

        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
        }
        $('.selectpicker').selectpicker("refresh");
    });
</script>
