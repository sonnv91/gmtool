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
                            <th>Set đồ</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data["options"]->cache_data as $option){?>
                            <tr>
                                <td><?php echo $this->lang->line($option->setId);?></td>
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
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/option/set/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="doc_type" value="SET_OPTION_CONFIG"/>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#basicInfo" aria-controls="basicInfo" role="tab" data-toggle="tab">Set đồ</a></li>
                        <li role="presentation"><a href="#attribute" aria-controls="attribute" role="tab" data-toggle="tab">Thuộc tính</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="basicInfo">
                            <div class="form-group">
                                <label for="inputMapName" class="col-sm-2 control-label">Set đồ</label>
                                <div class="col-sm-10">
                                    <select name="set_id" class="form-control" data-live-search="true">
                                        <?php foreach($this->config->item("SET_HOANGKIM") as $set){?>
                                            <option value="<?php echo $set;?>"><?php echo $this->lang->line($set);?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="attribute">
                            <button class="btn btn-block btn-success" id="add-effect-box">Thêm thuộc tính</button>
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
                <input type="hidden" name="doc_type" value="SET_OPTION_CONFIG"/>
                <input type="hidden" name="redirect" value="<?php echo base_url()."data/options/set";?>"/>
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
<div class="col-md-3" id="spellEffect" style="display: none">
    <div class="box box-success box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">Thuộc tính</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <input type="hidden" name="attr_type[]" value="OPTION_SET"/>
            <div class="form-group" id="attr_parent">
                <label for="exampleInputPassword1">Tên thuộc tính</label>
                <select name="attr_parent[]" class="form-control" data-live-search="true">
                    <?php foreach($data["option_set"]->cache_data as $opt){?>
                        <option value="<?php echo $opt->id;?>"><?php echo $opt->name;?></option>
                    <?php }?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Chỉ số</label>
                <input type="text" class="form-control" name="attr_value[]" value="0"/>
            </div>
        </div>
    </div>
</div>
<select name="attr_parent[]" class="form-control" style="display: none" id="OPTION_SET">
    <?php foreach($data["option_set"]->cache_data as $opt){?>
        <option value="<?php echo $opt->id;?>"><?php echo $opt->name;?></option>
    <?php }?>
</select>
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
    $(function() {
        $('.selectpicker').selectpicker();
        $(document).on('click', 'button[data-widget="remove"]', function () {
            $(this).parent().parent().parent().parent().remove();
            return false;
        });
        $(document).on('click', 'button#add-effect-box', function () {
            var effectBox = $("#spellEffect").clone();
            effectBox.removeAttr("id");
            effectBox.removeAttr("style");

            $(this).parent().append(effectBox);
            return false;
        });
    });
    $('#myModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        if(button.data('map') != 'none'){
            var data = jQuery.parseJSON(Base64.decode(button.data('map')))
            var options = data.options
            modal.find('.modal-title').text(data.setId)
            modal.find('input[name="id"]').val(data.id)
            modal.find('input[name="doc_type"]').val(data.docType)

            modal.find('select[name=set_id]>option[value='+data.setId+']').attr('selected','selected')

            if(options != null){
                createSpellEffect(modal, options)
            }
            $('.selectpicker').selectpicker("refresh");
        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
        }
    });
    function createSpellEffect(modal, options){
        modal.find("#attribute").empty()
        modal.find("#attribute").append('<button class="btn btn-block btn-success" id="add-effect-box">Thêm thuộc tính</button>')
        for( var i = 0; i < options.length; i++){
            var effectBox = $("#spellEffect").clone();
            effectBox.removeAttr("id");
            effectBox.removeAttr("style");
            effectBox.find("select[name='attr_parent[]']>option[value='"+options[i].parent+"']").attr("selected", "selected")
            effectBox.find("input[name='attr_value[]']").val(options[i].value)
            modal.find("#attribute").append(effectBox)
        }
    }
</script>