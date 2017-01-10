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
                            <th>Vip</th>
                            <th></th>
                        </tr>
                        <?php foreach($data->cache_data as $vip){?>
                            <tr>
                                <td>Vip <?php echo $vip->vip;?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($vip));?>">Sửa</button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $vip->id;?>">Xóa</button>
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
        <form class="form-horizontal" method="post" action="<?php echo base_url()."data/vip/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id"/>
                    <input type="hidden" name="doc_type" value="VIP"/>
                    <input type="hidden" name="vip" value="1"/>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">KNB yêu cầu</label>
                        <div class="col-sm-10">
                            <input type="number" name="coin_require" class="form-control" placeholder="version" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Số lần khiêu chiến</label>
                        <div class="col-sm-10">
                            <input type="number" name="max_fighting" class="form-control" placeholder="version" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Số lần mua lượt đánh boss</label>
                        <div class="col-sm-10">
                            <input type="number" name="max_buy_turn_boss_fighting" class="form-control" placeholder="version" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Số lần mua lượt đánh nhanh</label>
                        <div class="col-sm-10">
                            <input type="number" name="max_buy_turn_fast_fighting" class="form-control" placeholder="version" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Số lần đánh boss Bang hội free</label>
                        <div class="col-sm-10">
                            <input type="number" name="max_turn_free_boss_clan_fighting" class="form-control" placeholder="version" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Số lần tham bái Bang</label>
                        <div class="col-sm-2">
                            <input type="number" data-toggle="tooltip" data-placement="top" title="Số lần tham bái bằng bạc" name="max_turn_dedicate[]" class="form-control" placeholder="version" required value="0">
                        </div>
                        <div class="col-sm-2">
                            <input type="number" data-toggle="tooltip" data-placement="top" title="Số lần tham bái 50KNB" name="max_turn_dedicate[]" class="form-control" placeholder="version" required value="0">
                        </div>
                        <div class="col-sm-2">
                            <input type="number" data-toggle="tooltip" data-placement="top" title="Số lần tham bái 100KNB" name="max_turn_dedicate[]" class="form-control" placeholder="version" required value="0">
                        </div>
                        <div class="col-sm-2">
                            <input type="number" data-toggle="tooltip" data-placement="top" title="Số lần tham bái 200KNB" name="max_turn_dedicate[]" class="form-control" placeholder="version" required value="0">
                        </div>
                    </div><div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Số ô trong thương nhân</label>
                        <div class="col-sm-10">
                            <input type="number" name="max_slot_shop" class="form-control" placeholder="version" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Số lần vượt ải</label>
                        <div class="col-sm-10">
                            <input type="number" name="max_turn_party" class="form-control" placeholder="version" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Số lần đổi Bạc</label>
                        <div class="col-sm-10">
                            <input type="number" name="max_turn_buy_silver" class="form-control" placeholder="version" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tham gia Phong Lăng Độ</label>
                        <div class="col-sm-10">
                            <input type="number" name="max_turn_phonglangdo" class="form-control" placeholder="version" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Mô tả</label>
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
            <form class="form-horizontal" method="post" action="<?php echo base_url()."data/cache/delete";?>">
                <input type="hidden" name="id" value=""/>
                <input type="hidden" name="doc_type" value="VIP"/>
                <input type="hidden" name="redirect" value="<?php echo base_url()?>data/vips"/>
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
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $('#myModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)
        if(button.data('map') != 'none'){
            var vip = jQuery.parseJSON(Base64.decode(button.attr('data-map')))
            modal.find('.modal-title').text("Vip "+vip.vip)
            modal.find('input[name="id"]').val(vip.id)
            modal.find('input[name="vip"]').val(vip.vip)
            modal.find('input[name="coin_require"]').val(vip.coinRequire)
            modal.find('input[name="max_fighting"]').val(vip.maxFighting)
            modal.find('input[name="max_buy_turn_boss_fighting"]').val(vip.maxBuyTurnBossFighting)
            modal.find('input[name="max_buy_turn_fast_fighting"]').val(vip.maxBuyTurnFastFighting)
            modal.find('input[name="max_turn_free_boss_clan_fighting"]').val(vip.maxTurnFreeBossClanFighting)

            for(var i = 0; i < vip.maxTurnDedicate.length; i++){
                modal.find('input[name="max_turn_dedicate[]"]:eq('+i+')').val(vip.maxTurnDedicate[i])
            }
            modal.find('input[name="max_slot_shop"]').val(vip.maxSlotShop)
            modal.find('input[name="max_turn_party"]').val(vip.maxBuyTurnParty)
            modal.find('input[name="max_turn_buy_silver"]').val(vip.maxTurnBuySilver)
            modal.find('input[name="max_turn_phonglangdo"]').val(vip.maxTurnPhongLangDo)
            modal.find('textarea[name="description"]').val(vip.description)
        }else{
            modal.find('input[name="id"]').val("")
            modal.find('input[name="vip"]').val(<?php echo count($data->cache_data);?>)
            modal.find('.modal-title').text("Thêm mới")
        }

    });
</script>