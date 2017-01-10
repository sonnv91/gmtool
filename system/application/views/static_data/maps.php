<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên group</th>
                        <th>Code map</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                    <?php foreach($data->groups as $group){?>
                        <tr>
                            <td><?php echo $group->order;?></td>
                            <td><?php echo $group->name;?></td>
                            <td><?php echo $group->code;?></td>
                            <td><?php echo $group->description;?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo base_url()?>data/map/detail/<?php echo $group->id;?>" target="_blank" class="btn btn-success" role="button">Chi tiết</a>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($group));?>">Sửa</button>
                                    <button type="button" class="btn btn-danger" data-map="<?php echo $group->id;?>">Xóa</button>
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
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/map/group/save";?>">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id"/>
                <input type="hidden" name="doc_type"/>
                <input type="hidden" name="pos" value=""/>
                <div class="form-group">
                    <label for="inputOrder" class="col-sm-2 control-label">Thứ tự</label>
                    <div class="col-sm-10">
                        <input type="number" name="order" class="form-control" id="inputOrder" placeholder="Thứ tự" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputMapName" class="col-sm-2 control-label">Tên map</label>
                    <div class="col-sm-10">
                        <input type="text" name="group_name" class="form-control" id="inputMapName" placeholder="Tên map" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputMapCode" class="col-sm-2 control-label">Code</label>
                    <div class="col-sm-10">
                        <input type="text" name="code" class="form-control" id="inputMapCode" placeholder="code" required pattern="[A-Za-z0-9_]{1,50}" title="Code map chỉ chứa các ký tự _, a-z, 0-9">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputMapCode" class="col-sm-2 control-label">Mô tả</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" required name="description"></textarea>
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
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
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
<script>
    $('#myModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var groupMapData = jQuery.parseJSON(Base64.decode(button.attr('data-map')))
        var modal = $(this)
        modal.find('.modal-title').text(groupMapData.name)
        modal.find('input[name="id"]').val(groupMapData.id)
        modal.find('input[name="doc_type"]').val(groupMapData.docType)
        modal.find('input[name="group_name"]').val(groupMapData.name)
        modal.find('input[name=order]').val(groupMapData.order)
        modal.find('input[name=code]').val(groupMapData.code)
        modal.find('textarea[name=description]').val(groupMapData.description)
    });
</script>
