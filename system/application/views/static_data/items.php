<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <button type="button" class="btn btn-success" id="add-new" data-toggle="modal" data-target="#myModal" data-map="none">Thêm mới</button><br/>
                <label>Loại vật phẩm</label>
                <select class="form-control" style="width: 200px" id="item_type">
                    <?php foreach($this->config->item("ITEM_TYPE") as $type){ ?>
                        <option value="<?php echo $type;?>" <?php if($this->uri->segment(3) == $type) echo 'selected';?>><?php echo $this->lang->line($type);?></option>
                    <?php }?>
                    <option value="HOANG_KIM" <?php if($this->uri->segment(3) == "HOANG_KIM") echo 'selected';?>>Hoàng Kim</option>
                    <option value="STONE" <?php if($this->uri->segment(3) == "STONE") echo 'selected';?>>Đá thuộc tính</option>
                </select>
                <br/>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="datatable">
                        <thead>
                        <tr>
                            <th>Tên vật phẩm</th>
                            <th>ID</th>
                            <th>Cấp độ yêu cầu</th>
                            <th>Loại trang bị</th>
                            <th>Môn phái</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data["items"]->cache_data as $item){?>
                            <tr>
                                <td><?php echo $item->name;?></td>
                                <td><?php echo $item->id;?></td>
                                <td><?php echo $item->requireLevel;?></td>
                                <td><?php echo (isset($item->weaponType)) ? $this->lang->line($item->weaponType) : "";?></td>
                                <td><?php echo (isset($item->characterClass)) ? $this->lang->line($item->characterClass) : "";?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($item));?>">Sửa</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $item->id;?>">Xóa</button>
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
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/item/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="doc_type" value="<?php echo $data["docType"];?>"/>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tên vật phẩm</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" placeholder="Tên vật phẩm" required>
                        </div>
                    </div>
                    <?php if($data["docType"] == "HOANG_KIM"){?>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tên vật phẩm</label>
                        <div class="col-sm-10">
                            <select name="doc_type" class="form-control">
                                <?php foreach($this->config->item("EQUIPMENT") as $equip){?>
                                <option value="<?php echo $equip;?>"><?php echo $this->lang->line($equip);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <?php }?>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Code thumb</label>
                        <div class="col-sm-10">
                            <input type="text" name="code" class="form-control" placeholder="code thumb" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Phẩm chất</label>
                        <div class="col-sm-10">
                            <select name="quality" class="form-control">
                                <?php foreach($this->config->item("QUALITY") as $quality){?>
                                <option value="<?php echo $quality;?>"><?php echo $quality;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Số lượng xếp chồng</label>
                        <div class="col-sm-10">
                            <input type="number" name="stack_size" class="form-control" placeholder="code thumb" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Có thể nâng cấp</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="can_upgrade" class="minimal">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Rank</label>
                        <div class="col-sm-10">
                            <input type="number" name="rank" class="form-control" placeholder="xếp hạng" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Cấp độ yêu cầu</label>
                        <div class="col-sm-10">
                            <input type="number" name="require_level" class="form-control" required value="0">
                        </div>
                    </div>
                    <?php if($data["docType"] == "USABLE_ITEM"){?>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Gói quà</label>
                        <div class="col-sm-10">
                            <select name="reward_id" class="selectpicker" data-live-search="true">
                                <option></option>
                                <?php foreach($data["rewards"]->cache_data as $reward){ if($reward->type != "REWARD_MAP"){?>
                                    <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                                <?php }}?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Lợi ích</label>
                        <div class="col-sm-10">
                            <select name="usage_id" class="form-control">
                                <?php foreach($data["itemUsage"]->cache_data as $usage){?>
                                    <option value="<?php echo $usage->id;?>"><?php echo $usage->description;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <?php }?>
                    <?php if(in_array($data["docType"], $this->config->item("EQUIPMENT")) || $data["docType"] == "HOANG_KIM"){ ?>
                        <div class="form-group">
                            <label for="inputMapCode" class="col-sm-2 control-label">Set đồ</label>
                            <div class="col-sm-10">
                                <select name="set_id" class="form-control">
                                    <option></option>
                                    <?php foreach($this->config->item("SET_HOANGKIM") as $set){?>
                                        <option value="<?php echo $set;?>"><?php echo $this->lang->line($set);?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Trang bị môn phái</label>
                        <div class="col-sm-10">
                            <select name="character_class" class="form-control">
                                <option></option>
                                <?php foreach($this->config->item("CHARACTER_CLASS") as $class){?>
                                    <option value="<?php echo $class;?>"><?php echo $this->lang->line($class);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Loại trang bị</label>
                        <div class="col-sm-10">
                            <select name="equipment_type" class="form-control">
                                <option></option>
                                <?php foreach($this->config->item("EQUIPMENT_TYPE") as $equipType){?>
                                    <option value="<?php echo $equipType;?>"><?php echo $this->lang->line($equipType);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="inputMapCode" class="col-sm-2 control-label">Giới tính</label>
                            <div class="col-sm-10">
                                <select name="sex" class="form-control">
                                    <option value=""></option>
                                    <?php foreach($this->config->item("SEX") as $sex){?>
                                        <option value="<?php echo $sex;?>"><?php echo $this->lang->line($sex);?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    <?php if($data["docType"] == "WEAPON"){ ?>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Loại vũ khí</label>
                        <div class="col-sm-10">
                            <select name="weapon_type" class="form-control">
                                <option></option>
                                <?php foreach($this->config->item("WEAPON_TYPE") as $weaponType){?>
                                    <option value="<?php echo $weaponType;?>"><?php echo $this->lang->line($weaponType);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <?php }?>
                    <?php }?>
					<?php if($data["docType"] == "MATERIAL"){?>
					<div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Loại điểm tiềm năng</label>
                        <div class="col-sm-10">
                            <select name="stat_type" class="form-control">
                                <option></option>
                                <?php foreach($this->config->item("STAT_TYPE") as $statType){?>
                                    <option value="<?php echo $statType;?>"><?php echo $this->lang->line($statType);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Điểm tiềm năng</label>
                        <div class="col-sm-10">
                            <input type="number" name="value" class="form-control" required value="0">
                        </div>
                    </div>
					<div class="form-group">
						<label for="inputMapCode" class="col-sm-2 control-label">Option trang bị</label>
						<div class="col-sm-10">
							<select name="valid_equip[]" class="selectpicker" data-live-search="true" multiple>
								<?php foreach($this->config->item("EQUIPMENT") as $equip){?>
									<option value="<?php echo $equip;?>"><?php echo $this->lang->line($equip);?></option>
								<?php }?>
							</select>
						</div>
                   </div>
				   <div class="form-group">
						<label for="inputMapCode" class="col-sm-2 control-label">Option</label>
						<div class="col-sm-10">
							<select name="option_id" class="selectpicker" data-live-search="true">
								<option value="" ></option>
								<?php foreach($data["options"] as $opt){?>
									<option value="<?php echo $opt->id;?>" <?php styleOptionColor($opt->docType);?>><?php echo $opt->name;?></option>
								<?php }?>
							</select>
						</div>
                   </div>
				   <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Cấp độ</label>
                        <div class="col-sm-10">
                            <input type="number" name="level" class="form-control" required value="0">
                        </div>
                   </div>
						
					<?php }?>
					<div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Hiện VL phổ</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="visible_doc" class="minimal">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button id="save-btn2" type="button" class="btn btn-primary" data-loading-text="Loading...">Lưu lại</button>
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
                <input type="hidden" name="redirect" value="<?php echo base_url()."data/items/".$data["docType"]?>"/>
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
        "aaSorting": [[ 2, 'asc']]
    });
</script>
<script>
    $('select#item_type').on('change', function(){
        var value = $(this).val()
        window.location.href = '<?php echo base_url();?>data/items/'+value;
    });
    $('#myModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        if(button.data('map') != 'none'){
            var data = jQuery.parseJSON(Base64.decode(button.data('map')))
            modal.find('input[type="checkbox"]').prop("checked",false);
            modal.find('select>option').removeAttr("selected");

            modal.find('.modal-title').text(data.name)
            modal.find('input[name="id"]').val(data.id)
            modal.find('input[name="name"]').val(data.name)
            modal.find('input[name="code"]').val(data.code)
            modal.find('input[name="rank"]').val(data.rank)
            modal.find('input[name="level"]').val(data.level)
            if(data.value) modal.find('input[name="value"]').val(data.value)
            if(data.validEquip) modal.find('select[name="valid_equip[]"]').selectpicker('val', data.validEquip)
            if(data.optionId) modal.find('select[name="option_id"]').selectpicker('val', data.optionId)
			if(data.statType){
				modal.find('select[name="stat_type"]').val(data.statType)
				// modal.find('select[name="stat_type"]>option[value="'+data.statType+'"]').attr("selected","selected")
			} 
            modal.find('textarea[name="description"]').val(data.description)
            modal.find('input[name="stack_size"]').val(data.stackSize)
            modal.find('input[name="require_level"]').val(data.requireLevel)
            modal.find('select[name="quality"]').val(data.quality)
            modal.find('select[name="set_id"]').val(data.setId)
            modal.find('select[name="character_class"]').val(data.characterClass)
            modal.find('select[name="reward_id"]').val(data.rewardId)
            modal.find('select[name="usage_id"]').val(data.usageId)
            modal.find('select[name="equipment_type"]').val(data.equipmentType)
            modal.find('select[name="weapon_type"]').val(data.weaponType)
            modal.find('select[name="doc_type"]').val(data.docType)
            modal.find('select[name="sex"]').val(data.sex)
            if(data.canUpgrade) modal.find("input[name='can_upgrade']").prop('checked', true);
            if(data.visibleDoc) modal.find("input[name='visible_doc']").prop('checked', true);
			$('.selectpicker').selectpicker("refresh");	
        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
        }
    });
</script>