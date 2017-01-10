<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <form class="navbar-form pull-right col-lg-6" id="search-form" action="javascript:search()">
            <div class="input-group">
                <input type="text" name="search_key" class="form-control" placeholder="Từ khóa..." value="<?php echo $this->uri->segment(3) ? urldecode($this->uri->segment(3)) : "";?>">
                <span class="input-group-btn">
                    <input class="btn btn-default" type="submit" value="Tìm kiếm!"/>
                </span>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Tên đăng nhập</th>
                    <th>Tên nhân vật</th>
                    <th>Phái</th>
                    <th>Cấp độ</th>
                    <th>Server</th>
                    <th>Vip</th>
                    <th>KNB</th>
                    <th>Bạc</th>
                    <th>KNB nạp tích lũy</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($data["players"] as $player){?>
                    <tr>
                        <td><?php echo $player->owner;?></td>
                        <td><?php echo $player->name;?></td>
                        <td><?php echo $player->characterCode;?></td>
                        <td><?php echo $player->level;?></td>
                        <td><?php echo $player->server;?></td>
                        <td><?php echo $player->vip;?></td>
                        <td><?php echo $player->coin;?></td>
                        <td><?php echo $player->silver;?></td>
                        <td><?php echo $player->coinHoard;?></td>
                        <td></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" data-map="<?php echo base64_encode(json_encode($player));?>">Sửa</button>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-confirm" data-map="<?php echo $player->_id;?>">Ban</button>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-chat" data-map="<?php echo $player->_id."_".$player->server."_".$player->owner;?>">Unban</button>
                            </div>
                        </td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <?php echo $pagination; ?>
        </div>
    </div>
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="form-horizontal" method="post" action="<?php echo base_url()."user/save";?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id"/>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tên đăng nhập</label>
                        <div class="col-sm-10">
                            <input type="text" name="owner" class="form-control" placeholder="version" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Tên nhân vật</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" placeholder="version" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Server</label>
                        <div class="col-sm-10">
                            <input type="text" name="server" class="form-control" placeholder="version" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Vip</label>
                        <div class="col-sm-10">
                            <input type="number" name="vip" class="form-control" placeholder="version" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapCode" class="col-sm-2 control-label">KNB</label>
                        <div class="col-sm-10">
                            <input type="number" name="coin" class="form-control" required value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Bạc</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="silver" value="0" required>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Lượt đánh boss</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="turnBossFighting" value="0" required>
                        </div>
                    </div>
					<!--<div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Event 7 days</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="dayOfEventNewbie" value="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputMapName" class="col-sm-2 control-label">Qua ngày</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="number" name="passDay" value="0">
                        </div>
                    </div>-->
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
            <form class="form-horizontal" method="post" action="<?php echo base_url()."user/ban";?>">
                <input type="hidden" name="id" value=""/>
				<input type="hidden" name="doc_type" value="VIP"/>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">WARNING</h4>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc muốn ban user này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Ban</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" id="modal-chat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form class="form-horizontal" method="post" action="<?php echo base_url()."user/unban";?>">
                <input type="hidden" name="id" value=""/>
				<input type="hidden" name="server" value=""/>
				<input type="hidden" name="owner" value=""/>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">WARNING</h4>
                </div>
                <div class="modal-body">
                    <p>Bỏ khóa account nhé?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-success">Mở khóa</button>
                </div>
            </form>
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
    $('#myModal').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var modal = $(this)

        var player = jQuery.parseJSON(Base64.decode(button.data('map')))
        //alert(player._id.$id);
        modal.find('.modal-title').text(player.owner)
        modal.find('input[name="id"]').val(player._id.$id)
        modal.find('input[name="owner"]').val(player.owner)
        modal.find('input[name="name"]').val(player.name)
        modal.find('input[name="server"]').val(player.server)
        modal.find('input[name="vip"]').val(player.vip)
        //modal.find('input[name="coin"]').val(player.coin)
        //modal.find('input[name="silver"]').val(player.silver)
    });
</script>
<script>
    function search(){
        var form = $('form#search-form');
        var key = form.find('input[name="search_key"]').val() == "" ? -1 : form.find('input[name="search_key"]').val();
        window.location.href = '<?php echo base_url();?>user/list/'+key+'/0';
    }
</script>
