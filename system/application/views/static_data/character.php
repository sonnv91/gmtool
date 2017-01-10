<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <button type="submit" class="btn btn-success" id="add-new" data-toggle="modal" data-target="#myModal" data-map="none">Thêm mới</button><br/>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>Tên nhân vật</th>
                                <th>Phái</th>
                                <th>Giới tính</th>
                                <th>Code</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data->cache_data as $character){ ?>
                            <tr>
                                <td><?php echo $character->name;?></td>
                                <td><?php echo $this->lang->line($character->characterClass);?></td>
                                <td><?php echo ($character->female) ? "Nữ" : "Nam";?></td>
                                <td><?php echo $character->code;?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($character));?>">Sửa</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $character->id;?>">Xóa</button>
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
                <input type="hidden" name="doc_type" value="BASE_CHARACTER"/>
                <input type="hidden" name="redirect" value="<?php echo base_url()?>data/characters"/>
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
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/character/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#basicInfo" aria-controls="basicInfo" role="tab" data-toggle="tab">Thông tin cơ bản</a></li>
                            <li role="presentation"><a href="#basicParam" aria-controls="basicParam" role="tab" data-toggle="tab">Chỉ số</a></li>
                            <li role="presentation"><a href="#effect" aria-controls="effect" role="tab" data-toggle="tab">Hệ số thuộc tính</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <input type="hidden" name="id" value=""/>
                            <input type="hidden" name="doc_type" value="BASE_CHARACTER"/>
                            <div role="tabpanel" class="tab-pane active" id="basicInfo">
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Phái</label>
                                    <div class="col-sm-10">
                                        <select name="character_class" class="form-control">
                                            <?php foreach($this->config->item("CHARACTER_CLASS") as $class){ ?>
                                                <option value="<?php echo $class;?>"><?php echo $this->lang->line($class);?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tên phái</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputSkillName" placeholder="Tên class" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tên hiển thị</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="character_name" class="form-control" id="inputSkillName" placeholder="Tên hiển thị" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Giới tính</label>
                                    <div class="col-sm-10">
                                        <label>
                                            <input type="checkbox" name="sex[]" value="1" class="minimal-blue" checked/>
                                            Nam
                                        </label>
                                        <label>
                                            <input type="checkbox" name="sex[]" value="0" class="minimal-blue"/>
                                            Nữ
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Code thumb</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="code" class="form-control" id="inputSkillName" placeholder="Code thumb" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Mô tả</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="basicParam">
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">HP tăng mỗi cấp</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="health_perlevel" class="form-control" id="inputSkillName" placeholder="HP tăng mỗi cấp" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Nội lực tăng mỗi cấp</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="mana_perlevel" class="form-control" id="inputSkillName" placeholder="Nội lực tăng mỗi cấp" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tầm đánh</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="range" class="form-control" id="inputSkillName" placeholder="Tầm đánh" required>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Sức mạnh</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="strength" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Thân pháp</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="dexterity" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Sinh khí</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="vitality" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Nội công</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="energy" value="0"/>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Phòng thủ vật lý</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="physical_defense" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Kháng Độc</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="poison_resist" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Kháng Băng</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="water_resist" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Kháng Hỏa</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="fire_resist" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Kháng Lôi</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="lighting_resist" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tốc độ di chuyển</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="movement_speed" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tốc độ tấn công</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="attack_speed" value="0"/>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="effect">
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Sức mạnh</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="coefficient_strength" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Thân pháp</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="coefficient_dexterity" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Sinh khí</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="coefficient_vitality" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Nội công</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="coefficient_energy" value="0"/>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Nội lực</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="coefficient_mana" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Chính xác</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="coefficient_accuracy" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Chí Mạng</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="coefficient_critical" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Kháng chí mạng</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="coefficient_rescritical" value="0"/>
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
    $("input:checkbox").on('click', function() {
        var $box = $(this);
        if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });
    $('#myModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        if(button.data('map') != 'none'){
            var data = jQuery.parseJSON(Base64.decode(button.attr('data-map')))
            modal.find('.modal-title').text(data.name)
            modal.find('input[name="id"]').val(data.id)
            modal.find('input[name="doc_type"]').val(data.docType)
            modal.find('input[name="name"]').val(data.name)
            modal.find('input[name="character_name"]').val(data.characterName)
            modal.find('select[name=character_class]>option[value='+data.characterClass+']').attr('selected','selected')
            modal.find('input[name="sex[]"]').prop("checked",false)
            if(data.female){
                modal.find('input[name="sex[]"][value="0"]').prop( "checked",true )
            }else{
                modal.find('input[name="sex[]"][value="1"]').prop( "checked",true )
            }
            modal.find('input[name=code]').val(data.code)
            modal.find('textarea[name=description]').val(data.description)

            modal.find('input[name="strength"]').val(data.strength)
            modal.find('input[name="dexterity"]').val(data.dexterity)
            modal.find('input[name="vitality"]').val(data.vitality)
            modal.find('input[name="energy"]').val(data.energy)
            modal.find('input[name="range"]').val(data.range)
            modal.find('input[name="physical_defense"]').val(data.physicalDefense)
            modal.find('input[name="poison_resist"]').val(data.poisonResist)
            modal.find('input[name="water_resist"]').val(data.waterResist)
            modal.find('input[name="fire_resist"]').val(data.fireResist)
            modal.find('input[name="lighting_resist"]').val(data.lightingResist)
            modal.find('input[name="health_perlevel"]').val(data.healthPerLevel)
            modal.find('input[name="mana_perlevel"]').val(data.manaPerLevel)
            modal.find('input[name="movement_speed"]').val(data.movementSpeed)
            modal.find('input[name="attack_speed"]').val(data.attackSpeed)

            modal.find('input[name="coefficient_strength"]').val(data.coefficientStrength)
            modal.find('input[name="coefficient_dexterity"]').val(data.coefficientDexterity)
            modal.find('input[name="coefficient_vitality"]').val(data.coefficientVitality)
            modal.find('input[name="coefficient_energy"]').val(data.coefficientEnergy)
            modal.find('input[name="coefficient_mana"]').val(data.coefficientMana)
            modal.find('input[name="coefficient_accuracy"]').val(data.coefficientAccuracy)
            modal.find('input[name="coefficient_rescritical"]').val(data.coefficientResCritical)
            modal.find('input[name="coefficient_critical"]').val(data.coefficientCritical)

        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
            modal.find('input[name="doc_type"]').val("BASE_SKILL")
        }
    });
</script>