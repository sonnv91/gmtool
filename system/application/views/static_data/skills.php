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
                            <th>Tên tuyệt kỹ</th>
                            <th>Id</th>
                            <th>Phái</th>
                            <th>Cấp độ yêu cầu</th>
                            <th>Code</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data->cache_data as $skill){?>
                            <tr>
                                <td><?php echo $skill->name;?></td>
                                <td><?php echo $skill->id;?></td>
                                <td><?php echo $this->lang->line($skill->characterClass);?></td>
                                <td><?php echo $skill->unlock;?></td>
                                <td><?php echo $skill->code;?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($skill));?>">Sửa</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $skill->id;?>">Xóa</button>
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
                <input type="hidden" name="doc_type" value="BASE_SKILL"/>
                <input type="hidden" name="redirect" value="<?php echo base_url()?>data/skills"/>
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
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/skill/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#basicInfo" aria-controls="basicInfo" role="tab" data-toggle="tab">Thông tin cơ bản</a></li>
                            <li role="presentation"><a href="#basicParam" aria-controls="basicParam" role="tab" data-toggle="tab">Thông số</a></li>
                            <li role="presentation"><a href="#effect" aria-controls="effect" role="tab" data-toggle="tab">Hiệu quả</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <input type="hidden" name="id" value=""/>
                            <input type="hidden" name="doc_type" value="BASE_SKILL"/>
                            <div role="tabpanel" class="tab-pane active" id="basicInfo">
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tên tuyệt kỹ</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control" id="inputSkillName" placeholder="Tên tuyệt kỹ" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Code thumb</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="code" class="form-control" id="inputSkillName" placeholder="Code thumb" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Cấp độ yêu cầu</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="unlock" class="form-control" id="inputSkillName" placeholder="Cấp độ yêu cầu" required>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Yêu cầu tu luyện</label>
                                    <div class="col-sm-10">
                                        <input type="checkbox" name="require_train">
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
                                    <label for="inputMapName" class="col-sm-2 control-label">Tuyệt kỹ phái</label>
                                    <div class="col-sm-10">
                                        <select name="character_class" class="form-control">
                                            <?php foreach($this->config->item("CHARACTER_CLASS") as $class){ ?>
                                                <option value="<?php echo $class;?>"><?php echo $this->lang->line($class);?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Loại tuyệt kỹ</label>
                                    <div class="col-sm-10">
                                        <select name="skill_type" class="form-control">
                                            <?php foreach($this->config->item("SKILL_TYPE") as $type){ ?>
                                                <option value="<?php echo $type;?>"><?php echo $this->lang->line($type);?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Mục tiêu</label>
                                    <div class="col-sm-10">
                                        <select name="target" class="form-control">
                                            <?php foreach($this->config->item("SPELL_TARGET") as $target){ ?>
                                                <option value="<?php echo $target;?>"><?php echo $this->lang->line($target);?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Xác suất xuất hiện</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="probability" value="100"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Nội lực tiêu hao</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="cost" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tầm xa</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="range" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Thời gian khôi phục</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="countdown" value="0"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Tăng trưởng</label>
                                    <div class="col-sm-10">
                                        <select name="skill_growth[]" class="selectpicker" multiple data-live-search="true">
                                            <?php foreach($this->config->item("SKILL_GROWTH") as $skill_growth){ ?>
                                                <option value="<?php echo $skill_growth;?>"><?php echo $this->lang->line($skill_growth);?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Chỉ số tăng trưởng</label>
                                    <div class="col-sm-10">

                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="effect">
                                <button class="btn btn-block btn-success" id="add-effect-box">Thêm thuộc tính</button>
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
<div class="input-group" style="display: none" id="clone">
    <span class="input-group-addon"></span>
    <input type="text" class="form-control" name="" value="">
</div>
<div class="col-md-3" id="spellEffect" style="display: none">
    <div class="box box-success box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Tác dụng</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label for="exampleInputPassword1">Tên hiệu ứng</label>
                <input type="text" class="form-control" name="effect_name[]" value=""/>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Thuộc tính</label>
                <select name="effect_damage_type[]" class="form-control">
                    <?php foreach($this->config->item("DAMAGE_TYPE") as $damage_type){ ?>
                        <option value="<?php echo $damage_type;?>"><?php echo $this->lang->line($damage_type);?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Chỉ số tác động</label>
                <select name="effect_stat[]" class="form-control">
                    <?php foreach($this->config->item("SKILL_STAT") as $typeEffect){ ?>
                        <option value="<?php echo $typeEffect;?>"><?php echo $this->lang->line($typeEffect);?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mức độ tác động</label>
                <input type="text" class="form-control" name="effect_degree[]" value="0"/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Thời gian tác động</label>
                <input type="text" class="form-control" name="effect_duration[]" value="0s"/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Tăng trưởng</label>
                <input type="text" class="form-control" name="effect_growth[]" value="0"/>
            </div>
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
        "aaSorting": [[ 2, 'desc'],[3, 'asc']]
    });
</script>
<script>
    $(function(){
        $('.selectpicker').selectpicker();
        $(document).on('click', 'button[data-widget="remove"]', function(){
            $(this).parent().parent().parent().parent().remove();
            return false;
        });
        $(document).on('click', 'button#add-effect-box', function(){
            var effectBox = $("#spellEffect").clone();
            effectBox.removeAttr("id");
            effectBox.removeAttr("style");

            $(this).parent().append(effectBox);
            return false;
        });
        $(document).on("change", "select[name='skill_growth[]']", function(){
            var form_group = $(this).closest("div.form-group").next().find(".col-sm-10");
            form_group.find(".input-group").each(function(){
                if($("select[name='skill_growth[]']").val() == null){
                    form_group.empty();
                }else{
                    if($("select[name='skill_growth[]']").val().indexOf($(this).attr("id")) < 0){
                        $(this).next("br").remove()
                        $(this).remove()
                    }
                }
            });
            var total = $("select[name='skill_growth[]']").val().length;
            for(var i = 0; i < total; i++){
                var val = $("select[name='skill_growth[]']").val()[i]
                if(form_group.find("div#"+val).length < 1){
                    var input_group = $("div.input-group[id='clone']").clone()
                    input_group.removeAttr("style")
                    input_group.removeAttr("id")
                    input_group.attr("id",val)
                    input_group.attr("select-data",true)
                    input_group.find("span").html($("select[name='skill_growth[]']>option[value='"+val+"']").html())
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
            var spellEffects = data.spellEffects;
            var growth = data.growth;
            modal.find('.modal-title').text(data.name)
            modal.find('input[name="id"]').val(data.id)
            modal.find('input[name="doc_type"]').val(data.docType)
            modal.find('input[name="name"]').val(data.name)
            modal.find('input[name=code]').val(data.code)
            modal.find('input[name=unlock]').val(data.unlock)
            modal.find('textarea[name=description]').val(data.description)

            modal.find('select[name=character_class]').val(data.characterClass)
            modal.find('select[name=skill_type]').val(data.type)
            modal.find('select[name=target]').val(data.target)
            modal.find('input[name=cost]').val(data.cost)
            modal.find('input[name=range]').val(data.range)
            modal.find('input[name=countdown]').val(data.countdown)
            modal.find('input[name=probability]').val(data.probability)
            modal.find('select[name="skill_growth[]"]>option').removeAttr("selected")
			if(data.requireTrain){
                    $("input[name='require_train']").attr('checked', 'checked');
                }else{
                    $("input[name='require_train']").removeAttr('checked');
                }
            var form_group = $('select[name="skill_growth[]"]').closest("div.form-group").next().find(".col-sm-10");
            form_group.empty()
			var valSkillGrowth = [];
            if(growth != null){
                jQuery.each(growth, function(name, value) {
                    if(value != null){
						valSkillGrowth.push(name)
                        var input_group = $("div.input-group[id='clone']").clone()
                        input_group.removeAttr("style")
                        input_group.removeAttr("id")
                        input_group.attr("id",name)
                        input_group.find("span").html($("select[name='skill_growth[]']>option[value='"+name+"']").html())
                        input_group.find("input").attr("name",name)
                        input_group.find("input").val(value)
                        form_group.append(input_group)
                        form_group.append("<br/>")
                    }
                });
				modal.find('select[name="skill_growth[]"]').selectpicker('val', valSkillGrowth);
            }

            if(spellEffects != null){
                modal.find("#effect").find("#spellEffect").remove()
                createSpellEffect(modal, spellEffects)
            }
            $('.selectpicker').selectpicker("refresh");
        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
            modal.find('input[name="doc_type"]').val("BASE_SKILL")
        }
    });
    function createSpellEffect(modal, spellEffects){
        modal.find("#effect").empty()
        modal.find("#effect").append('<button class="btn btn-block btn-success" id="add-effect-box">Thêm thuộc tính</button>');
        for( var i = 0; i < spellEffects.length; i++){
            var effectBox = $("#spellEffect").clone();
            effectBox.removeAttr("id");
            effectBox.removeAttr("style");

            effectBox.find("input[name='effect_name[]']").val(spellEffects[i].name)
            effectBox.find("select[name='effect_damage_type[]']>option[value='"+spellEffects[i].damageType+"']").attr('selected','selected')
            effectBox.find("select[name='effect_stat[]']>option[value='"+spellEffects[i].stat+"']").attr('selected','selected')
            effectBox.find("input[name='effect_degree[]']").val(spellEffects[i].degree)
            effectBox.find("input[name='effect_duration[]']").val(spellEffects[i].duration)
            effectBox.find("input[name='effect_growth[]']").val(spellEffects[i].growth)
            modal.find("#effect").append(effectBox)
        }
    }
</script>
