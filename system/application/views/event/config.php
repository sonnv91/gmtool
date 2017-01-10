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
                    <table class="table table-hover" id="datatable">
                        <tr>
                            <th>Sự kiện</th>
                            <th>Server</th>
                            <th>Mô tả</th>
                            <th>Bắt đầu</th>
                            <th>Kết thúc</th>
                            <th></th>
                        </tr>
                        <?php foreach($listEvent as $event){?>
                            <tr <?php if($now > $event->endTime->sec){echo 'style="color:red"';}?>>
                                <td><?php echo $this->lang->line($event->eventType);?></td>
                                <td><?php echo $event->server;?></td>
                                <td><?php echo $event->description;?></td>
                                <td><?php echo DateUtil::formatTime($event->createTime->sec);?></td>
                                <td><?php echo DateUtil::formatTime($event->endTime->sec);?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($event));?>">Sửa</button>
                                        <?php if($now > $event->endTime->sec || $now < $event->createTime->sec){?><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $event->_id;?>">Xóa</button><?php }?>
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
        <form class="form-horizontal" method="post" action="<?php echo base_url()."event/conf/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Thêm mới</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_id"/>
                    <input type="hidden" name="doc_type" value="EVENT"/>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 ">Loại event</label>
                        <div class="col-sm-10">
                            <select name="eventType" class="form-control">
                                <?php foreach($this->config->item("EVENT") as $type){?>
                                <option value="<?php echo $type;?>"><?php echo $this->lang->line($type);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2">Server</label>
                        <div class="col-sm-10">
                            <select name="server" class="selectpicker">
                                <option value="all">Tất cả</option>
                                <?php foreach($listServer as $server){?>
                                <option value="<?php echo $server->code;?>"><?php echo $server->code." - ".$server->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Bắt đầu:</label>
                        <div class="col-sm-10">
                            <input id="datemask" name="createTime" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 ">Kết thúc:</label>
                        <div class="col-sm-10">
                            <input id="datemask" name="endTime" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 ">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea name="description" class="textarea" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
            <form class="form-horizontal" method="post" action="<?php echo base_url()."event/conf/delete";?>">
                <input type="hidden" name="id" value=""/>
                <input type="hidden" name="redirect" value="<?php echo base_url()."event/config";?>"/>
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
<script src="<?php echo base_url();?>public/temp/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>public/temp/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>public/temp/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script>
    $(function () {
        $("input[id^='datemask']").inputmask("datetime")
        $('.selectpicker').selectpicker();
        $('#datatable').DataTable( {
            "aaSorting": [[ 1, 'asc']]
        });
    });
    $('#myModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        if(button.data('map') != 'none'){
            var event = jQuery.parseJSON(Base64.decode(button.attr('data-map')))
            var from = new Date(event.createTime.sec * 1000)
            var to = new Date(event.endTime.sec * 1000)

            modal.find('.modal-title').text("Sự kiện")
            modal.find('input[name="_id"]').attr('value',event._id.$id)
            modal.find('input[name="createTime"]').val(formatTimeVN(from))
            modal.find('input[name="endTime"]').val(formatTimeVN(to))
            modal.find('textarea[name="description"]').val(event.description)

            modal.find('select>option').removeAttr('selected')
            modal.find('select>option').attr('disabled',true)
            modal.find('select[name="eventType"]>option[value="'+event.eventType+'"]').attr('selected','selected').removeAttr('disabled')
            modal.find('select[name="server"]>option[value="'+event.server+'"]').attr('selected','selected').removeAttr('disabled')
        }else{
            modal.find('input[name="_id"]').val("")
            modal.find('select>option').not(':selected').removeAttr('disabled')
            modal.find('.modal-title').text("Thêm mới")
        }
        $('.selectpicker').selectpicker("refresh");
    });
</script>