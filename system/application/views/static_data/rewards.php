<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <button type="submit" class="btn btn-block btn-success" id="add-new" data-toggle="modal" data-target="#myModal" data-map="none">Thêm mới</button><br/>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="datatable">
                        <thead>
                        <tr>
                            <th>Tên gói quà</th>
                            <th>Id</th>
                            <th>Loại quà</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data["rewards"]->cache_data as $reward){?>
                            <tr>
                                <td><?php echo $reward->name;?></td>
                                <td><?php echo $reward->id;?></td>
                                <td><?php echo $this->lang->line($reward->type);?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($reward));?>">Sửa</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $reward->id;?>">Xóa</button>
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
<div class="modal fade bs-example-modal-sm" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form class="form-horizontal" method="post" action="<?php echo base_url()."data/cache/delete";?>">
                <input type="hidden" name="id" value=""/>
                <input type="hidden" name="doc_type" value="REWARD"/>
                <input type="hidden" name="redirect" value="<?php echo base_url()?>data/rewards"/>
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
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/reward/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#funds" aria-controls="funds" role="tab" data-toggle="tab">Tiền tệ</a></li>
                            <li role="presentation"><a href="#randomEquip" aria-controls="randomEquip" role="tab" data-toggle="tab">Trang bị ngẫu nhiên(Lv)</a></li>
                            <li role="presentation"><a href="#usable" aria-controls="usable" role="tab" data-toggle="tab">Vật phẩm sử dụng</a></li>
                            <li role="presentation"><a href="#staticEquip" aria-controls="staticEquip" role="tab" data-toggle="tab">Trang bị</a></li>
                            <li role="presentation"><a href="#material" aria-controls="material" role="tab" data-toggle="tab">Nguyên liệu</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <input type="hidden" name="id" value=""/>
                            <input type="hidden" name="doc_type" value="REWARD"/>
                            <div role="tabpanel" class="tab-pane active" id="funds">
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tên gói quà</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" placeholder="Tên gói quà" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Kiểu gói quà</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" name="type">
                                            <?php foreach($this->config->item("REWARD_TYPE") as $type){?>
                                            <option value="<?php echo $type;?>"><?php echo $this->lang->line($type);?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Exp</label>
                                    <div class="col-sm-3">
                                        <input type="number" name="exp[]" value="0" class="form-control" placeholder="Min" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" name="exp[]" value="0" class="form-control" placeholder="Max" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Bạc</label>
                                    <div class="col-sm-3">
                                        <input type="number" name="silver[]" value="0" class="form-control" placeholder="Min" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" name="silver[]" value="0" class="form-control" placeholder="Max" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">KNB</label>
                                    <div class="col-sm-3">
                                        <input type="number" name="coin[]" value="0" class="form-control" placeholder="Min" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" name="coin[]" value="0" class="form-control" placeholder="Max" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Điểm danh vọng</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="credit" value="0" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Điểm tống kim</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="tk_point" value="0" class="form-control" required>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Điểm Song đấu</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="sd_point" value="0" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Số item có thể nhận</label>
                                    <div class="col-sm-3">
                                        <input type="number" name="number_item_receive" value="0" class="form-control" placeholder="Min" required>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="randomEquip">
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ nhận</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="rate_drop[]" class="form-control" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Số lần nhận</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="quantity_drop[]" value="1" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Cấp độ item</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="fixed_level" value="1" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ phẩm chất</label>
                                    <div class="col-sm-2">
                                        <input type="number" name="rate_quality[]" value="30" class="form-control" data-toggle="tooltip" data-placement="top" title="Phẩm chất trắng"/>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" name="rate_quality[]" value="30" class="form-control" data-toggle="tooltip" data-placement="top" title="Phẩm chất Xanh lá"/>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" name="rate_quality[]" value="30" class="form-control" data-toggle="tooltip" data-placement="top" title="Phẩm chất Xanh dương"/>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" name="rate_quality[]" value="10" class="form-control" data-toggle="tooltip" data-placement="top" title="Phẩm chất Tím"/>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" name="rate_quality[]" value="0" class="form-control" data-toggle="tooltip" data-placement="top" title="Phẩm chất Vàng"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ loại trang bị</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_equipment[]" value="11" class="form-control" data-toggle="tooltip" data-placement="top" title="Vũ khí"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_equipment[]" value="11" class="form-control" data-toggle="tooltip" data-placement="top" title="Áo"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_equipment[]" value="11" class="form-control" data-toggle="tooltip" data-placement="top" title="Giầy"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_equipment[]" value="11" class="form-control" data-toggle="tooltip" data-placement="top" title="Bao tay"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_equipment[]" value="11" class="form-control" data-toggle="tooltip" data-placement="top" title="Mũ"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_equipment[]" value="11" class="form-control" data-toggle="tooltip" data-placement="top" title="Ngọc bội"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_equipment[]" value="11" class="form-control" data-toggle="tooltip" data-placement="top" title="Dây chuyền"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_equipment[]" value="11" class="form-control" data-toggle="tooltip" data-placement="top" title="Nhẫn"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_equipment[]" value="12" class="form-control" data-toggle="tooltip" data-placement="top" title="Đai lưng"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ rank item</label>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_rank[]" value="0" class="form-control" data-toggle="tooltip" data-placement="top" title="Rank 1"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_rank[]" value="0" class="form-control" data-toggle="tooltip" data-placement="top" title="Rank 2"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_rank[]" value="0" class="form-control" data-toggle="tooltip" data-placement="top" title="Rank 3"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_rank[]" value="0" class="form-control" data-toggle="tooltip" data-placement="top" title="Rank 4"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_rank[]" value="0" class="form-control" data-toggle="tooltip" data-placement="top" title="Rank 5"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_rank[]" value="0" class="form-control" data-toggle="tooltip" data-placement="top" title="Rank 6"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_rank[]" value="0" class="form-control" data-toggle="tooltip" data-placement="top" title="Rank 7"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_rank[]" value="0" class="form-control" data-toggle="tooltip" data-placement="top" title="Rank 8"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_rank[]" value="0" class="form-control" data-toggle="tooltip" data-placement="top" title="Rank 9"/>
                                    </div>
                                    <div class="col-sm-1">
                                        <input type="text" name="rate_rank[]" value="0" class="form-control" data-toggle="tooltip" data-placement="top" title="Rank 10"/>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="usable">
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ nhận</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="rate_drop[]" value="0" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Số lần nhận</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="quantity_drop[]" value="1" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Nhận ngẫu nhiên</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" name="usable_item_random"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Vật phẩm nhận</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" name="usable_item_id[]" multiple id="multiple-1" data-live-search="true">
                                            <?php foreach($data["usableItem"]->cache_data as $material){?>
                                                <option value="<?php echo $material->id;?>"><?php echo $material->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ - Số lượng</label>
                                    <div class="col-sm-10">

                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="staticEquip">
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ nhận</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="rate_drop[]" class="form-control" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Số lần nhận</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="quantity_drop[]" value="1" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Nhận ngẫu nhiên</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" name="static_random"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Vật phẩm nhận</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" name="static_item_id[]" multiple id="multiple-2" data-live-search="true">
                                            <?php foreach($data["baseItem"]->cache_data as $base){?>
                                                <option value="<?php echo $base->id;?>"><?php echo $base->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ - Số lượng</label>
                                    <div class="col-sm-10">

                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="material">
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ nhận</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="rate_drop[]" class="form-control" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Số lần nhận</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="quantity_drop[]" value="1" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Nhận ngẫu nhiên</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" name="material_random"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Vật phẩm nhận</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" name="material_item_id[]" multiple id="multiple-3" data-live-search="true">
                                            <?php foreach($data["material"]->cache_data as $material){?>
                                                <option value="<?php echo $material->id;?>"><?php echo $material->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tỉ lệ - Số lượng</label>
                                    <div class="col-sm-10">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button id="save-btn" type="button" class="btn btn-primary" data-loading-text="Loading...">Lưu lại</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="input-group" style="display: none" id="multiple-1">
    <span class="input-group-addon"></span>
    <input type="text" class="form-control col-sm-2" name="usable_item_rate" value="0">
    <input type="text" class="form-control col-sm-2" name="usable_item_qtt" value="1">
</div>
<div class="input-group" style="display: none" id="multiple-2">
    <span class="input-group-addon"></span>
    <input type="text" class="form-control col-sm-2" name="static_item_rate" value="0">
    <input type="text" class="form-control col-sm-2" name="static_item_qtt" value="1">
</div>
<div class="input-group" style="display: none" id="multiple-3">
    <span class="input-group-addon"></span>
    <input type="text" class="form-control col-sm-2" name="material_rate" value="0">
    <input type="text" class="form-control col-sm-2" name="material_qtt" value="1">
</div>
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
        "aaSorting": [[ 1, 'desc'],[2, 'asc']]
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
<script>
    $(function(){
        $('.selectpicker').selectpicker();
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
                       $(this).attr('name', $(this).attr('name')+'-'+val)
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
    });
    $('#myModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        if(button.data('map') != 'none'){
            var data = jQuery.parseJSON(Base64.decode(button.attr('data-map')))
            var materialItems = data.materialItems
            var staticEquipment = data.staticEquipment
            var randomEquipment = data.randomEquipment
            var usableItem = data.usableItems

            modal.find('.modal-title').text(data.name)
            modal.find('input[name="id"]').val(data.id)
            modal.find('input[name="doc_type"]').val(data.docType)
            modal.find('input[name="name"]').val(data.name)
            modal.find('input[name="exp[]"]:eq(0)').val(data.exp[0])
            modal.find('input[name="exp[]"]:eq(1)').val(data.exp[1])
            modal.find('input[name="silver[]"]:eq(0)').val(data.silver[0])
            modal.find('input[name="silver[]"]:eq(1)').val(data.silver[1])
            modal.find('input[name="coin[]"]:eq(0)').val(data.coin[0])
            modal.find('input[name="coin[]"]:eq(1)').val(data.coin[1])
            modal.find('input[name="number_item_receive"]').val(data.numberItemReceive)
            modal.find('input[name="credit"]').val(data.credit)
            modal.find('input[name="sd_point"]').val(data.sdPoint)

            if(randomEquipment != null){
                modal.find('input[name="fixed_level"]').val(randomEquipment.fixedLevel)
                if(randomEquipment.rateQuality != null){
                    for(var i = 0; i < randomEquipment.rateQuality.length; i++){
                        modal.find('input[name="rate_quality[]"]:eq('+i+')').val(randomEquipment.rateQuality[i])
                    }
                }
                for(var i = 0; i < randomEquipment.rateEquipment.length; i++){
                    modal.find('input[name="rate_equipment[]"]:eq('+i+')').val(randomEquipment.rateEquipment[i])
                }

                if(randomEquipment.rateRank != null){
                    for(var i = 0; i < randomEquipment.rateRank.length; i++){
                        modal.find('input[name="rate_rank[]"]:eq('+i+')').val(randomEquipment.rateRank[i])
                    }
                }
            }
            for(var i = 0; i < data.rateDrop.length; i++ ){
                modal.find('input[name="rate_drop[]"]:eq('+i+')').val(data.rateDrop[i])
            }
            for(var i = 0; i < data.quantityDrop.length; i++ ){
                modal.find('input[name="quantity_drop[]"]:eq('+i+')').val(data.quantityDrop[i])
            }
            modal.find('select[name=type]>option[value='+data.type+']').attr('selected','selected')
            modal.find('select[name="static_item_id[]"]>option').removeAttr("selected")
            modal.find('select[name="material_item_id[]"]>option').removeAttr("selected")
            modal.find('select[name="usable_item_id[]"]>option').removeAttr("selected")
            var form_group_usable_item = $('select[name="usable_item_id[]"]').closest("div.form-group").next().find(".col-sm-10");
            var form_group_static_item = $('select[name="static_item_id[]"]').closest("div.form-group").next().find(".col-sm-10");
            var form_group_material = $('select[name="material_item_id[]"]').closest("div.form-group").next().find(".col-sm-10");
            form_group_usable_item.empty()
            form_group_static_item.empty()
            form_group_material.empty()
			
			var valUsableItem = [];
			var valStaticItem = [];
			var valMaterial = [];

            if(usableItem != null){
                if(usableItem.random){
                    $("input[name='usable_item_random']").prop('checked', true);
                }else{
                    $("input[name='usable_item_random']").prop('checked', false);
                }
                for( var i = 0; i< usableItem.baseItemId.length; i++){
                    // modal.find('select[name="usable_item_id[]"]>option[value="'+usableItem.baseItemId[i]+'"]').attr("selected","selected")
					valUsableItem.push(usableItem.baseItemId[i]);
                    var input_group = $("div.input-group[id='multiple-1']").clone()
                    input_group.removeAttr("style")
                    input_group.removeAttr("id")
                    input_group.find("input").each(function(){
                        $(this).attr('name', $(this).attr('name')+'-'+usableItem.baseItemId[i])
                    });
                    input_group.attr("id",usableItem.baseItemId[i])
                    input_group.find("span").html($("select[name='usable_item_id[]']>option[value='"+usableItem.baseItemId[i]+"']").html())
                    input_group.find("input[name='usable_item_qtt-"+usableItem.baseItemId[i]+"']").val(usableItem.quantityDrop[i])
                    input_group.find("input[name='usable_item_rate-"+usableItem.baseItemId[i]+"']").val(usableItem.rateDrop[i])
                    form_group_usable_item.append(input_group)
                    form_group_usable_item.append("<br/>")
                }
            }

            if(staticEquipment != null){
                if(staticEquipment.random){
                    $("input[name='static_random']").prop('checked', true);
                }else{
                    $("input[name='static_random']").prop('checked', false);
                }
                for( var i = 0; i< staticEquipment.baseItemId.length; i++){
                    // modal.find('select[name="static_item_id[]"]>option[value="'+staticEquipment.baseItemId[i]+'"]').attr("selected","selected")
					valStaticItem.push(staticEquipment.baseItemId[i])
                    var input_group = $("div.input-group[id='multiple-2']").clone()
                    input_group.removeAttr("style")
                    input_group.removeAttr("id")
                    input_group.find("input").each(function(){
                        $(this).attr('name', $(this).attr('name')+'-'+staticEquipment.baseItemId[i])
                    });
                    input_group.attr("id",staticEquipment.baseItemId[i])
                    input_group.find("span").html($("select[name='static_item_id[]']>option[value='"+staticEquipment.baseItemId[i]+"']").html())
                    input_group.find("input[name='static_item_qtt-"+staticEquipment.baseItemId[i]+"']").val(staticEquipment.quantityDrop[i])
                    input_group.find("input[name='static_item_rate-"+staticEquipment.baseItemId[i]+"']").val(staticEquipment.rateDrop[i])
                    form_group_static_item.append(input_group)
                    form_group_static_item.append("<br/>")
                }
            }
            if(materialItems != null){
                if(materialItems.random){
                    $("input[name='material_random']").prop('checked', true);
                }else{
                    $("input[name='material_random']").prop('checked', false);
                }
                for( var i = 0; i< materialItems.baseItemId.length; i++){
                    // modal.find('select[name="material_item_id[]"]>option[value="'+materialItems.baseItemId[i]+'"]').attr("selected","selected")
					valMaterial.push(materialItems.baseItemId[i])
                    var input_group = $("div.input-group[id='multiple-3']").clone()
                    input_group.removeAttr("style")
                    input_group.removeAttr("id")
                    input_group.find("input").each(function(){
                        $(this).attr('name', $(this).attr('name')+'-'+materialItems.baseItemId[i])
                    });
                    input_group.attr("id",materialItems.baseItemId[i])
                    input_group.find("span").html($("select[name='material_item_id[]']>option[value='"+materialItems.baseItemId[i]+"']").html())
                    input_group.find("input[name='material_qtt-"+materialItems.baseItemId[i]+"']").val(materialItems.quantityDrop[i])
                    input_group.find("input[name='material_rate-"+materialItems.baseItemId[i]+"']").val(materialItems.rateDrop[i])
                    form_group_material.append(input_group)
                    form_group_material.append("<br/>")
                }
            }
			// alert(valMaterial);
			modal.find('select[name="static_item_id[]"]').selectpicker('val', valStaticItem);
            modal.find('select[name="material_item_id[]"]').selectpicker('val', valMaterial);
            modal.find('select[name="usable_item_id[]"]').selectpicker('val', valUsableItem);
			$('.selectpicker').selectpicker("refresh");
        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
        }
    });
</script>
