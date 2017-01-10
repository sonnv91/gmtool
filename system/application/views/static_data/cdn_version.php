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
                            <th>CDN</th>
                            <th>Version</th>
                            <th>type</th>
                            <th>Url</th>
                            <th></th>
                        </tr>
                        <?php foreach($data as $cdn){?>
                            <tr>
                                <td><?php echo $cdn->docType;?></td>
                                <td><?php echo isset($cdn->version) ? $cdn->version : "";?></td>
                                <td><?php echo isset($cdn->configType) ? $cdn->configType : "";?></td>
                                <td><?php echo isset($cdn->url) ? $cdn->url: "";?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($cdn));?>">Sửa</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $cdn->id;?>" data-doc="<?php echo $cdn->docType;?>">Xóa</button>
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
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/cdn/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id"/>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">CDN</label>
                        <div class="col-sm-10">
                            <select name="doc_type" class="form-control">
                                <?php foreach($this->config->item("CDN") as $cdn){ ?>
                                    <option value="<?php echo $cdn;?>"><?php echo $this->lang->line($cdn);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Client</label>
                        <div class="col-sm-10">
                            <select name="client_type" class="form-control">
                                <?php foreach($this->config->item("CLIENT_TYPE") as $client){ ?>
                                    <option value="<?php echo $client;?>"><?php echo $this->lang->line($client);?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Version</label>
                        <div class="col-sm-10">
                            <input type="text" name="version" class="form-control" placeholder="version" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Url</label>
                        <div class="col-sm-10">
                            <input type="url" name="url" class="form-control" placeholder="http://example.com" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Bắt buộc</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="mandatory">
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
                <input type="hidden" name="doc_type" value=""/>
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
            var cdn = jQuery.parseJSON(Base64.decode(button.data('map')))
            var clientType = cdn.clientType
            modal.find('select>option').removeAttr('selected');
            modal.find('.modal-title').text(cdn.docType)
            modal.find('input[name="id"]').val(cdn.id)
            modal.find('select[name="doc_type"]>option[value="'+cdn.docType+'"]').attr('selected', 'selected')
            modal.find('select[name="client_type"]>option[value="'+clientType+'"]').attr('selected', 'selected')
            modal.find('input[name="version"]').val(cdn.version)
            modal.find('input[name="url"]').val(cdn.url)
            if(cdn.mandatory){
                modal.find('input[name="mandatory"]').prop('checked', true)
            }else{
                modal.find('input[name="mandatory"]').prop('checked', false)
            }
        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
        }

    });
</script>