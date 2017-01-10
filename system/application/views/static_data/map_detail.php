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
                    <table class="table table-hover">
                        <tr>
                            <th>Tên map</th>
                            <th>Id</th>
                            <th>Code map</th>
                            <th>Cấp độ</th>
                            <th></th>
                        </tr>
                        <?php foreach($data->maps as $map){ if( $this->uri->segment(4) == $map->parent){?>
                            <tr>
                                <td><?php echo $map->name;?><?php if($map->mapPk){ echo '<span style="color: red; font-weight: bold">(PK)</span>';}?></td>
                                <td><?php echo $map->id;?></td>
                                <td><?php echo $map->code;?></td>
                                <td><?php echo $map->level;?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($map))?>">Sửa</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $map->id;?>">Xóa</button>
                                    </div>
                                </td>
                            </tr>
                        <?php }}?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/map/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="doc_type" value="MAP"/>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Nhóm map</label>
                        <div class="col-sm-10">
                            <select name="parent" class="form-control">
                                <?php foreach($data->groups as $group){ ?>
                                    <option value="<?php echo $group->id;?>"><?php echo $group->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tên map</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="inputMapName" placeholder="Tên map" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Code</label>
                        <div class="col-sm-10">
                            <input type="text" name="code" class="form-control" id="inputMapCode" placeholder="code" required pattern="[A-Za-z0-9_]{1,50}" title="Code map chỉ chứa các ký tự _, a-z, 0-9">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Cấp độ</label>
                        <div class="col-sm-10">
                            <input type="number" name="level" class="form-control" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Rank</label>
                        <div class="col-sm-10">
                            <input type="number" name="rank" class="form-control" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Phần thưởng</label>
                        <div class="col-sm-10">
                            <div class="col-sm-10">
                                <select name="reward_id" class="selectpicker" data-live-search="true">
                                    <?php foreach($data->rewards as $reward){ ?>
                                        <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Phần thưởng boss</label>
                        <div class="col-sm-10">
                            <div class="col-sm-10">
                                <select name="boss_reward_id" class="selectpicker" data-live-search="true">
                                    <?php foreach($data->rewards as $reward){ ?>
                                        <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Boss</label>
                        <div class="col-sm-10">
                            <div class="col-sm-10">
                                <select name="boss_id" class="selectpicker" data-live-search="true">
                                    <?php foreach($data->mobs as $mob){ if($mob->boss){?>
                                        <option value="<?php echo $mob->id;?>"><?php echo $mob->name."(Lv.".$mob->level.")";?></option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Chiến lực</label>
                        <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="force" value="1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Map PK</label>
                        <div class="col-sm-10">
                            <div class="col-sm-10">
                                <input type="checkbox" name="map_pk">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Mob</label>
                        <div class="col-sm-10">
                            <select name="list_mob_id[]" class="selectpicker" multiple data-live-search="true">
                                <?php foreach($data->mobs as $mob){ /*if(!$mob->boss){*/?>
                                    <option value="<?php echo $mob->id;?>"><?php echo $mob->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Rate Mob</label>
                        <div class="col-sm-10">

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
                <input type="hidden" name="doc_type" value="MAP"/>
                <input type="hidden" name="redirect" value="<?php echo current_url()?>"/>
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
<div class="input-group" style="display: none" id="clone">
    <span class="input-group-addon"></span>
    <input type="text" class="form-control" name="" value="">
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
    $(function(){
        $(document).on("change", "select[name='list_mob_id[]']", function(){
            $('.selectpicker').selectpicker("refresh");
            var form_group = $(this).closest("div.form-group").next().find(".col-sm-10");
            form_group.find(".input-group").each(function(){
                if($("select[name='list_mob_id[]']").val() == null){
                    form_group.empty();
                }else{
                    if($("select[name='list_mob_id[]']").val().indexOf($(this).attr("id")) < 0){
                        $(this).next("br").remove()
                        $(this).remove()
                    }
                }
            });
            var total = $("select[name='list_mob_id[]']").val().length;
            for(var i = 0; i < total; i++){
                var val = $("select[name='list_mob_id[]']").val()[i]
                if(form_group.find("div#"+val).length < 1){
                    var input_group = $("div.input-group[id='clone']").clone()
                    input_group.removeAttr("style")
                    input_group.removeAttr("id")
                    input_group.attr("id",val)
                    input_group.find("span").html($("select[name='list_mob_id[]']>option[value='"+val+"']").html())
                    input_group.find("input").attr("name",val)
                    input_group.find("input").val(0)
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
			modal.find('.modal-title').text(data.name)
			modal.find('input[name="id"]').val(data.id)
			//modal.find('input[name="doc_type"]').val(data.docType)
			modal.find('input[name="name"]').val(data.name)
			modal.find('input[name="level"]').val(data.level)
			modal.find('input[name="rank"]').val(data.rank)
			modal.find('input[name=code]').val(data.code)
			modal.find('input[name=force]').val(data.force)
			if(data.mapPk){
				modal.find('input[name=map_pk]').attr("checked","checked")
			}else{
				modal.find('input[name=map_pk]').removeAttr("checked")
			}
			modal.find('select[name=boss_id]>option[value='+data.bossId+']').attr('selected','selected')
			modal.find('select[name=parent]>option[value='+data.parent+']').attr('selected','selected')
			modal.find('select[name=reward_id]>option[value='+data.rewardId+']').attr('selected','selected')
			modal.find('select[name=boss_reward_id]>option[value='+data.bossRewardId+']').attr('selected','selected')
			modal.find('select[name="list_mob_id[]"]>option').removeAttr("selected")
			var form_group = $('select[name="list_mob_id[]"]').closest("div.form-group").next().find(".col-sm-10")
			form_group.empty()
			for(var i = 0; i < data.listMobId.length; i++){
				modal.find('select[name="list_mob_id[]"]>option[value="'+ data.listMobId[i]+'"]').attr("selected","selected")
				var input_group = $("div.input-group[id='clone']").clone()
				input_group.removeAttr("style")
				input_group.removeAttr("id")
				input_group.attr("id",data.listMobId[i])
				input_group.find("span").html($("select[name='list_mob_id[]']>option[value='"+data.listMobId[i]+"']").html())
				input_group.find("input").attr("name",data.listMobId[i])
				input_group.find("input").val(data.rateMob[i])
				form_group.append(input_group)
				form_group.append("<br/>")
			}
		}
		else{
			modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
		}
        $('.selectpicker').selectpicker("refresh");
    });
</script>
