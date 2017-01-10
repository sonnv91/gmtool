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
                            <th>Tên server</th>
                            <th>Mã server</th>
                            <th>Vị trí</th>
                            <th></th>
                        </tr>
                        <?php foreach($serverList as $server){?>
                            <tr>
                                <td><?php echo $server->name;?></td>
                                <td><?php echo $server->code;?></td>
                                <td><?php echo $server->index;?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($server));?>">Sửa</button>
                                        <!--<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $server->id;?>" data-doc="<?php echo $server->docType;?>">Xóa</button>-->
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
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/server/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id"/>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tên server</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" placeholder="Tên server" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Mã server</label>
                        <div class="col-sm-10">
                            <input type="text" name="code" class="form-control" placeholder="Mã server" pattern="[A-Za-z0-9_]{1,6}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Vị trí</label>
                        <div class="col-sm-10">
                            <input type="number" name="index" class="form-control" placeholder="vị trí">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Api Url</label>
                        <div class="col-sm-10">
                            <input type="url" name="url" class="form-control" placeholder="http://example.com" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Trạng thái</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control">
                                <?php foreach($this->config->item("SERVER_STATUS") as $serverStatus){ ?>
                                    <option value="<?php echo $serverStatus;?>"><?php echo $this->lang->line($serverStatus);?></option>
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
                <input type="hidden" name="doc_type" value=""/>
                <input type="hidden" name="redirect" value="<?php echo base_url()?>tools/server"/>
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
            var server = jQuery.parseJSON(Base64.decode(button.data('map')))

            modal.find('.modal-title').text(server.name)
            modal.find('input[name="id"]').val(server.id)
            modal.find('select[name="status"]>option[value="'+server.serverStatus+'"]').attr('selected', 'selected')
            modal.find('input[name="code"]').val(server.code)
            modal.find('input[name="code"]').attr('readonly','readonly')
            modal.find('input[name="name"]').val(server.name)
            modal.find('input[name="index"]').val(server.index)
            modal.find('input[name="url"]').val(server.url)
        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
            modal.find('input[name="code"]').removeAttr('readonly')
        }

    });
</script>