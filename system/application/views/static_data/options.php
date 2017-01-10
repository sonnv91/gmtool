<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <button type="button" class="btn btn-success" id="add-new" data-toggle="modal" data-target="#myModal" data-map="none">Thêm mới</button><br/>
                <label>Loại thuộc tính</label>
                <select class="form-control" style="width: 200px" id="opt_type">
                    <?php foreach($this->config->item("OPTIONS") as $optType){ ?>
                    <option value="<?php echo $optType;?>" <?php if($this->uri->segment(3) == $optType) echo 'selected';?>><?php echo $this->lang->line($optType);?></option>
                    <?php }?>
                </select>
                <br/>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>Tên thuộc tính</th>
                                <th>Loại thuộc tính</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data["options"]->cache_data as $option){?>
                            <tr>
                                <td><?php echo $option->name;?></td>
                                <td><?php echo $this->lang->line($option->docType);?></td>
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
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/option/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="doc_type" value="<?php echo $data["docType"];?>"/>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tên thuộc tính</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="inputMapName" placeholder="Tên thuộc tính" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Hệ số</label>
                        <div class="col-sm-10">
                            <input type="text" name="coefficient" class="form-control" placeholder="Hệ số" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Hệ số chiến lực</label>
                        <div class="col-sm-10">
                            <input type="number" name="coefficient_power" class="form-control" placeholder="Hệ số chiến lưc" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Chỉ số %</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="percent" class="minimal">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tuyệt kỹ</label>
                        <div class="col-sm-10">
                            <select name="skill_id" class="form-control">
                                <option></option>
                                <?php foreach($data["skills"]->cache_data as $skill){ ?>
                                    <option value="<?php echo $skill->id;?>"><?php echo $skill->name." (".$this->lang->line($skill->characterClass).")";?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Hiệu quả thuộc tính</label>
                        <div class="col-sm-10">
                            <select name="stat" class="form-control">
                                <option></option>
                                <?php foreach($this->config->item("EQUIPMENT_OPTION") as $stat){ ?>
                                    <option value="<?php echo $stat;?>"><?php echo $this->lang->line($stat);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Độ hiếm</label>
                        <div class="col-sm-10">
                            <input type="number" name="rare" class="form-control" id="inputMapCode" placeholder="Độ hiếm 1->10" required min="0" max="10" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Trang bị có thể nhận thuộc tính</label>
                        <div class="col-sm-10">
                            <?php foreach($this->config->item("EQUIPMENT") as $equip){ ?>
                                <label>
                                    <input type="checkbox" class="minimal" name="equipment_type[]" value="<?php echo $equip; ?>"/>
                                    <?php echo $this->lang->line($equip);?>
                                </label><br>
                            <?php }?>
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
<div class="modal fade bs-example-modal-sm" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form class="form-horizontal" method="post" action="<?php echo base_url()."data/cache/delete";?>">
                <input type="hidden" name="id" value=""/>
                <input type="hidden" name="doc_type" value="<?php echo $data["docType"];?>"/>
                <input type="hidden" name="redirect" value="<?php echo base_url()?>data/options"/>
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
    $('select#opt_type').on('change', function(){
        var value = $(this).val()
        window.location.href = '<?php echo base_url();?>data/options/'+value;
    });
    $('#myModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        if(button.data('map') != 'none'){
            var data = jQuery.parseJSON(Base64.decode(button.data('map')))
            modal.find('input[type="checkbox"]').prop("checked",false);
            // modal.find('select>option').removeAttr("selected");

            var equipmentType = data.equipmentType
            modal.find('.modal-title').text(data.name)
            modal.find('input[name="id"]').val(data.id)
            modal.find('input[name="doc_type"]').val(data.docType)
            modal.find('input[name="name"]').val(data.name)
            modal.find('input[name="coefficient"]').val(data.coefficient)
            modal.find('input[name="coefficient_power"]').val(data.coefficientPower)
            modal.find('input[name="rare"]').val(data.rare)
            modal.find('select[name="stat"]').val(data.stat)
            if(data.skillId != null) modal.find('select[name="skill_id"]').val(data.skillId)
            if(data.percent){
                modal.find("input[name='percent']").prop('checked', true);
            }

            if(equipmentType != null){
                for(var i = 0; i< equipmentType.length; i++){
                    modal.find('input[value="'+equipmentType[i]+'"]').prop('checked', true);
                }
            }

        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
        }
    });
</script>
