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
                            <th>Tầng thứ</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($configs as $config){?>
                            <tr>
                                <td><?php echo $config->roomIndex;?></td>
                                <td>
                                    <div class="btn-group">
                                        <button id="info-btn" type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($config));?>">Sửa</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $config->id;?>">Xóa</button>
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
                <input type="hidden" name="doc_type" value="PARTY_ROOM_ADVANCED"/>
                <input type="hidden" name="redirect" value="<?php echo base_url()?>data/party_advanced"/>
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
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/party_advanced/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#main" aria-controls="main" role="tab" data-toggle="tab">Thông tin cơ bản</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <input type="hidden" name="id" value=""/>
                            <input type="hidden" name="doc_type" value="PARTY_ROOM"/>
                            <div role="tabpanel" class="tab-pane active" id="main">
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Ải thứ</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="index" class="form-control" placeholder="tấng thứ" required min="1">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Gói quà lần đầu</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" name="reward_first" data-live-search="true">
                                            <?php foreach($rewards as $reward){?>
                                                <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Gói quà</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" name="reward" data-live-search="true">
                                            <?php foreach($rewards as $reward){?>
                                                <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label class="col-sm-2 control-label">Điểm nhận được</label>
                                    <div class="col-sm-2">
										<input type="number" name="vd_point" class="form-control" placeholder="điểm" required min="0" value="0">
									</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Boss ải</label>
                                    <div class="col-sm-10">
                                        <select class="selectpicker" name="boss_id" data-live-search="true">
                                            <?php foreach($mobs as $mob){if($mob->boss){?>
                                                <option value="<?php echo $mob->id;?>"><?php echo isset($mob->level) ? $mob->name."($mob->level)" : $mob->name;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
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
        "aaSorting": [[ 1, 'desc'],[2, 'asc']]
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>
<script>
    $(document).on('show.bs.modal', '#myModal', function(e){
        var button = $(e.relatedTarget)
        var modal = $(this)
        if(button.data('map') != 'none'){
            var data = jQuery.parseJSON(Base64.decode(button.attr('data-map')))
            modal.find('.modal-title').text(data.roomIndex)
            modal.find('input[name="id"]').val(data.id)
            modal.find('input[name="doc_type"]').val(data.docType)
            modal.find('input[name="index"]').val(data.roomIndex)
            modal.find('input[name="vd_point"]').val(data.vdPoint)
            modal.find('select[name=reward_first]>option[value='+data.rewardFirst+']').attr('selected','selected')
            modal.find('select[name=reward]>option[value='+data.reward+']').attr('selected','selected')
            modal.find('select[name=boss_id]>option[value='+data.bossId+']').attr('selected','selected')

            $('.selectpicker').selectpicker("refresh");
        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
        }
    } );
    //    $('#myModal').on('show.bs.modal', function (e) {
    //
    //    });
</script>