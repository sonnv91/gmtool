<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <button type="button" class="btn btn-success" id="add-new" data-toggle="modal" data-target="#myModal" data-map="none">Thêm mới</button><br/>
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Tên vật phẩm</th>
                            <th>Loại vật phẩm</th>
                            <th>Số lượng</th>
                            <th>Xác suất</th>
                            <th></th>
                        </tr>
                        <?php foreach($shop_config->cache_data as $shop){?>
                            <tr>
                                <td><?php echo $items[$shop->parentId]["name"];?></td>
                                <td><?php echo $this->lang->line($items[$shop->parentId]["doc_type"]);?></td>
                                <td><?php echo $shop->quantity;?></td>
                                <td><?php echo $shop->rate;?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($shop));?>">Sửa</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $shop->id;?>">Xóa</button>
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
<div class="modal fade bs-example-modal-sm" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form class="form-horizontal" method="post" action="<?php echo base_url()."data/cache/delete";?>">
                <input type="hidden" name="id" value=""/>
                <input type="hidden" name="doc_type" value="SHOP_CONFIG"/>
                <input type="hidden" name="redirect" value="<?php echo base_url()?>data/shop"/>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/shop/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="doc_type" value="SHOP_CONFIG"/>
                    <div class="form-group">
                        <label for="inputOrder" class="col-sm-2 control-label">Vật phẩm</label>
                        <div class="col-sm-10">
                            <select name="parent_item" class="form-control selectpicker" data-live-search="true">
                                <?php foreach($items as $key => $value){?>
                                <option value="<?php echo $key.'-'.$value["doc_type"];?>"><?php echo $value["name"];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Số lượng</label>
                        <div class="col-sm-10">
                            <input type="number" name="quantity" class="form-control" id="inputMapName" placeholder="Số lượng" required value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Tỉ lệ</label>
                        <div class="col-sm-10">
                            <input type="number" name="rate" class="form-control" id="inputMapCode" placeholder="Tỉ lệ" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Base KNB</label>
                        <div class="col-sm-10">
                            <input type="number" name="base_coin" class="form-control" id="inputMapCode" placeholder="base_coin" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">Base Bạc</label>
                        <div class="col-sm-10">
                            <input type="number" name="base_silver" class="form-control" id="inputMapCode" placeholder="base_silver" required value="0">
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
    $(function() {
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    $('#myModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        if(button.data('map') != 'none'){
            var cdn = jQuery.parseJSON(Base64.decode(button.attr('data-map')))
            modal.find('select>option').removeAttr('selected');
            modal.find('.modal-title').text("")
            modal.find('input[name="id"]').val(cdn.id)
            modal.find('select[name="parent_item"]>option[value="'+cdn.parentId+'-'+cdn.type+'"]').attr('selected', 'selected')
            modal.find('input[name="quantity"]').val(cdn.quantity)
            modal.find('input[name="rate"]').val(cdn.rate)
            modal.find('input[name="base_coin"]').val(cdn.baseCoin)
            modal.find('input[name="base_silver"]').val(cdn.baseSilver)
            $('.selectpicker').selectpicker("refresh");
        }else{
            modal.find('input[name="id"]').val("")
            modal.find('.modal-title').text("Thêm mới")
        }

    });
</script>
