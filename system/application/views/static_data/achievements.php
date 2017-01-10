<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" data-map="none">Thêm mới</button><br/>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Tên danh hiệu</th>
                            <th>Tên nhiệm vụ</th>
                            <th></th>
                        </tr>
                        <?php foreach($data as $acm){?>
                            <tr>
                                <td><?php echo $acm->name;?></td>
                                <td><?php echo $acm->description;?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($acm));?>">Sửa</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $acm->id;?>">Xóa</button>
                                    </div>
                                </td>
                            </tr>
                        <?php }?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/achievement/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="doc_type" value="ACHIEVEMENT"/>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Action</label>
                        <div class="col-sm-10">
                            <select name="action" class="form-control">
                                <?php foreach($this->config->item("ACHIEVEMENT_TYPE") as $cdn){ ?>
                                    <option value="<?php echo $cdn;?>"><?php echo $this->lang->line($cdn);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Code thumb</label>
                        <div class="col-sm-10">
                            <input type="text" name="code" class="form-control" placeholder="thumb" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tên danh hiệu</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" placeholder="Tên danh hiệu" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Tên nhiệm vụ</label>
                        <div class="col-sm-10">
                            <input type="text" name="description" class="form-control" placeholder="Tên nhiệm vụ" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Mô tả chi tiết</label>
                        <div class="col-sm-10">
                            <textarea name="detail" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Mốc hoàn thành</label>
                        <div class="col-sm-10">
                            <input type="number" name="milestone" class="form-control" placeholder="Mốc hoàn thành" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Phần thưởng nhiệm vụ</label>
                        <div class="col-sm-10">
                            <select name="reward_id" class="selectpicker" data-live-search="true">
                                <?php foreach($rewards as $reward){ ?>
                                    <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                                <?php }?>
                            </select>
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
                <input type="hidden" name="doc_type" value="ACHIEVEMENT"/>
                <input type="hidden" name="redirect" value="<?php echo base_url()?>data/version"/>
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
    $('#myModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        if(button.data('map') != 'none'){
            var achievement = jQuery.parseJSON(Base64.decode(button.attr('data-map')))
            modal.find('select>option').removeAttr('selected');
            modal.find('.modal-title').text(achievement.name)
            modal.find('input[name="id"]').val(achievement.id)
            modal.find('select[name="action"]>option[value="'+achievement.action+'"]').attr('selected', 'selected')
            modal.find('input[name="name"]').val(achievement.name)
            modal.find('input[name="code"]').val(achievement.code)
            modal.find('input[name="description"]').val(achievement.description)
            modal.find('textarea[name="detail"]').val(achievement.detail)
            modal.find('input[name="milestone"]').val(achievement.mileStone)
            modal.find('select[name="reward_id"]>option[value="'+achievement.rewardId+'"]').attr('selected', 'selected')
        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
        }
        $('.selectpicker').selectpicker("refresh");

    });
</script>