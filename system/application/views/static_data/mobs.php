<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="margin">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-generate">Generate Mob</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-mob" data-map="none">Create Mob</button>
            </div>
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>Tên</th>
								<th>Id</th>
                                <th>Cấp độ</th>
                                <th>Lực tay</th>
                                <th>Máu</th>
                                <th>Map</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data["mobs"]->cache_data as $mob){?>
                                <tr>
                                    <td <?php if($mob->boss){echo 'style="color:red;font-weight:bold"';}?>><?php echo $mob->name;?></td>
                                    <td><?php echo $mob->id;?></td>
                                    <td><?php echo $mob->level;?></td>
                                    <td><?php echo $mob->handForce;?></td>
                                    <td><?php echo $mob->health;?></td>
                                    <td><?php echo isset($data["maps"][$mob->id]) ? $data["maps"][$mob->id] : "";?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-mob" data-map="<?php echo base64_encode(json_encode($mob));?>">Sửa</button>
                                            <!--<button type="button" class="btn btn-danger">Xóa</button>-->
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
<div class="modal fade bs-example-modal-lg" id="modal-generate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/mobs/generate";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Generate Mob</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="inputOrder" class="col-sm-2 control-label">Chọn map</label>
                        <div class="col-sm-10">
                            <select name="map_id" class="selectpicker" data-live-search="true">
                                <?php foreach($data["map_config"]->cache_data as $map){ ?>
                                    <option value="<?php echo $map->id;?>"><?php echo $map->name;?><?php if($map->mapPk){echo ' (PK)';}?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Số lượng skill tấn công</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="num_atk_skill" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Số lượng skill hỗ trợ</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="num_bonus_skill" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Cấp độ skill</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="level_skill" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputOrder" class="col-sm-2 control-label">Chọn mob</label>
                        <div class="col-sm-10">
                            <select name="base_char_id[]" class="selectpicker" multiple data-live-search="true">
                                <?php foreach($data["baseChar"]->cache_data as $base){ ?>
                                    <option value="<?php echo $base->id;?>"><?php echo $base->name;?> (<?php echo $base->characterClass;?>)</option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg" id="modal-mob" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/mob/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#basicInfo" aria-controls="basicInfo" role="tab" data-toggle="tab">Chỉ số cơ bản</a></li>
                        <li role="presentation"><a href="#resist" aria-controls="basicParam" role="tab" data-toggle="tab">Chỉ số kháng</a></li>
                        <li role="presentation"><a href="#ignoreResist" aria-controls="effect" role="tab" data-toggle="tab">Bỏ qua kháng</a></li>
                        <li role="presentation"><a href="#skill" aria-controls="skill" role="tab" data-toggle="tab">Tuyệt kỹ</a></li>
                    </ul>
                    <div class="tab-content">
                        <input type="hidden" name="id"/>
                        <input type="hidden" name="doc_type" value="MOB"/>
                        <div role="tabpanel" class="tab-pane active" id="basicInfo">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tên mob</label>
                                <div class="col-sm-10">
                                    <select name="parent" class="selectpicker" data-live-search="true">
                                        <?php foreach($data["baseChar"]->cache_data as $char){ ?>
                                            <option value="<?php echo $char->id;?>"><?php echo $char->name;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Cấp độ</label>
                                <div class="col-sm-10">
                                    <input type="number" name="level" value="1" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Loại damage</label>
                                <div class="col-sm-10">
                                    <select name="damage_type" class="form-control" data-live-search="true">
                                        <?php foreach($this->config->item("MOB_DAMAGE_TYPE") as $type){ ?>
                                            <option value="<?php echo $type;?>"><?php echo $this->lang->line($type);?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">BOSS</label>
                                <div class="col-sm-10">
                                    <input type="checkbox" name="boss">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sức mạnh</label>
                                <div class="col-sm-10">
                                    <input type="number" name="strength" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Sinh khí</label>
                                <div class="col-sm-10">
                                    <input type="number" name="vitality" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Thân pháp</label>
                                <div class="col-sm-10">
                                    <input type="number" name="dexterity" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nội công</label>
                                <div class="col-sm-10">
                                    <input type="number" name="energy" class="form-control" required value="0">
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Lực tay</label>
                                <div class="col-sm-10">
                                    <input type="number" name="hand_force" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Máu</label>
                                <div class="col-sm-10">
                                    <input type="number" name="health" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Chính xác</label>
                                <div class="col-sm-10">
                                    <input type="number" name="accuracy" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nội lực</label>
                                <div class="col-sm-10">
                                    <input type="number" name="mana" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Né tránh</label>
                                <div class="col-sm-10">
                                    <input type="number" name="dodge_chance" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Bạo kích</label>
                                <div class="col-sm-10">
                                    <input type="number" name="critical" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Chí mạng</label>
                                <div class="col-sm-10">
                                    <input type="number" name="chimang" class="form-control" required value="0">
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="resist">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Phòng thủ vật lý</label>
                                <div class="col-sm-10">
                                    <input type="text" name="physical_defense" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kháng bạo kích</label>
                                <div class="col-sm-10">
                                    <input type="text" name="critical_resist" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kháng chí mạng</label>
                                <div class="col-sm-10">
                                    <input type="text" name="chimang_resist" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kháng độc</label>
                                <div class="col-sm-10">
                                    <input type="text" name="poison_resist" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kháng băng</label>
                                <div class="col-sm-10">
                                    <input type="text" name="water_resist" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kháng hỏa</label>
                                <div class="col-sm-10">
                                    <input type="text" name="fire_resist" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kháng lôi</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lighting_resist" class="form-control" required value="0">
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="ignoreResist">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Bỏ qua phòng thủ vật lý</label>
                                <div class="col-sm-10">
                                    <input type="text" name="ignore_physical_defense" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Bỏ qua kháng độc</label>
                                <div class="col-sm-10">
                                    <input type="text" name="ignore_poison_resist" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Bỏ qua kháng băng</label>
                                <div class="col-sm-10">
                                    <input type="text" name="ignore_water_resist" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Bỏ qua kháng hỏa</label>
                                <div class="col-sm-10">
                                    <input type="text" name="ignore_fire_resist" class="form-control" required value="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Bỏ qua kháng lôi</label>
                                <div class="col-sm-10">
                                    <input type="text" name="ignore_lighting_resist" class="form-control" required value="0">
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="skill">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tuyệt kỹ tấn công</label>
                                <div class="col-sm-10">
                                    <select name="left_frame[]" class="selectpicker" data-live-search="true" multiple>
                                        <?php foreach($data["skills"]->cache_data as $mobSkill){ if($data["baseSkill"][$mobSkill->parent]["type"] == "DAMAGE"){?>
                                        <option value="<?php echo $mobSkill->id;?>"><?php echo $data["baseSkill"][$mobSkill->parent]["name"];?> (<?php echo $data["baseSkill"][$mobSkill->parent]["characterClass"]." Lv.".$mobSkill->level?>)</option>
                                        <?php }}?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Kỹ năng hỗ trợ</label>
                                <div class="col-sm-10">
                                    <select name="right_frame[]" class="selectpicker" data-live-search="true" multiple>
                                        <?php foreach($data["skills"]->cache_data as $mobSkill){ if($data["baseSkill"][$mobSkill->parent]["type"] == "BONUS"){?>
                                            <option value="<?php echo $mobSkill->id;?>"><?php echo $data["baseSkill"][$mobSkill->parent]["name"];?> (<?php echo $data["baseSkill"][$mobSkill->parent]["characterClass"]." Lv.".$mobSkill->level?>)</option>
                                        <?php }}?>
                                    </select>
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
    $(function(){
        $('.selectpicker').selectpicker();
    });
    $('#modal-mob').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        if(button.data('map') != 'none'){
            var data = jQuery.parseJSON(Base64.decode(button.attr('data-map')))
            var leftFrame = data.leftFrame
            var rightFrame = data.rightFrame
            modal.find('select>option').removeAttr('selected')
            modal.find('input[name="id"]').val(data.id)
            modal.find('.modal-title').text(data.name)
            modal.find('select[name="parent"]>option[value='+data.parent+']').attr('selected','selected')
            modal.find('select[name="damage_type"]>option[value='+data.damageType+']').attr('selected','selected')
            modal.find('input[name="boss"]').prop("checked", data.boss)

            modal.find('input[name="strength"]').val(data.strength)
            modal.find('input[name="level"]').val(data.level)
            modal.find('input[name="vitality"]').val(data.vitality)
            modal.find('input[name="dexterity"]').val(data.dexterity)
            modal.find('input[name="energy"]').val(data.energy)
            modal.find('input[name="hand_force"]').val(data.handForce)
            modal.find('input[name="health"]').val(data.health)
            modal.find('input[name="accuracy"]').val(data.accuracy)
            modal.find('input[name="mana"]').val(data.mana)
            modal.find('input[name="dodge_chance"]').val(data.dodgeChance)
            modal.find('input[name="critical"]').val(data.critical)
            modal.find('input[name="chimang"]').val(data.chimang)

            modal.find('input[name="physical_defense"]').val(data.physicalDefense)
            modal.find('input[name="critical_resist"]').val(data.criticalResist)
            modal.find('input[name="chimang_resist"]').val(data.chimangResist)
            modal.find('input[name="poison_resist"]').val(data.poisonResist)
            modal.find('input[name="water_resist"]').val(data.waterResist)
            modal.find('input[name="fire_resist"]').val(data.fireResist)
            modal.find('input[name="lighting_resist"]').val(data.lightingResist)

            modal.find('input[name="ignore_physical_defense"]').val(data.ignorePhysicalDefense)
            modal.find('input[name="ignore_critical_resist"]').val(data.ignoreCriticalResist)
            modal.find('input[name="ignore_chimang_resist"]').val(data.ignoreChimangResist)
            modal.find('input[name="ignore_poison_resist"]').val(data.ignorePoisonResist)
            modal.find('input[name="ignore_water_resist"]').val(data.ignoreWaterResist)
            modal.find('input[name="ignore_fire_resist"]').val(data.ignoreFireResist)
            modal.find('input[name="ignore_lighting_resist"]').val(data.ignoreLightingResist)
            if(leftFrame != null){
                for(var i = 0; i < leftFrame.length; i++){
                    modal.find('select[name="left_frame[]"]>option[value='+leftFrame[i]+']').attr('selected','selected')
                }
            }
            if(rightFrame != null){
                for(var i = 0; i < rightFrame.length; i++){
                    modal.find('select[name="right_frame[]"]>option[value='+rightFrame[i]+']').attr('selected','selected')
                }
            }
            $('.selectpicker').selectpicker("refresh");
        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
        }
    });
</script>
