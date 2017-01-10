<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#system" aria-controls="system" role="tab" data-toggle="tab">Hệ thống</a></li>
                        <li role="presentation"><a href="#activities" aria-controls="activities" role="tab" data-toggle="tab">Hoạt động</a></li>
                        <li role="presentation"><a href="#reward_private" aria-controls="reward_private" role="tab" data-toggle="tab">Phần thưởng riêng</a></li>
                        <li role="presentation"><a href="#reward_public" aria-controls="reward_public" role="tab" data-toggle="tab">Phần thưởng chung</a></li>
                        <li role="presentation"><a href="#notify" aria-controls="notify" role="tab" data-toggle="tab">Công cáo</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="system">
                            <form action="<?php echo base_url();?>tools/sendMessage" method="post" role="form">
                                <input type="hidden" name="messageType" value="SYSTEM"/>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Server</label>
                                    <div class="col-sm-10">
                                        <select name="server" class="selectpicker" data-live-search="true">
                                            <option value="all">Tất cả</option>
                                            <?php foreach($serverList as $server){?>
                                                <option value="<?php echo $server->code;?>"><?php echo $server->code." - ".$server->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tiêu đề</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="title" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Nội dung</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="form-control" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="button" id="save" class="btn btn-default">Gửi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="activities">
                            <form action="<?php echo base_url();?>tools/sendMessage" method="post" role="form">
                                <input type="hidden" name="messageType" value="ACTIVITY"/>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Server</label>
                                    <div class="col-sm-10">
                                        <select name="server" class="selectpicker" data-live-search="true">
                                            <option value="all">Tất cả</option>
                                            <?php foreach($serverList as $server){?>
                                                <option value="<?php echo $server->code;?>"><?php echo $server->code." - ".$server->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tiêu đề</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="title" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Nội dung</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="form-control" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Link</label>
                                    <div class="col-sm-10">
                                        <input type="url" name="link" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="button" id="save" class="btn btn-default">Gửi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="reward_private">
                            <form action="<?php echo base_url();?>tools/sendMessage" method="post">
                                <input type="hidden" name="messageType" value="REWARD_PRIVATE"/>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Danh sách user</label>
                                    <div class="col-sm-10">
                                        <textarea name="owner" class="form-control" rows="8"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tiêu đề</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="title" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Nội dung</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="form-control" rows="8"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Gói quà</label>
                                    <div class="col-sm-10">
                                        <select name="rewardId" class="selectpicker" data-live-search="true">
                                            <option value="-1">Rỗng</option>
                                            <?php foreach($rewards as $reward){ if($reward->type != "REWARD_MAP"){?>
                                                <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="button" id="save" class="btn btn-default">Gửi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="reward_public">
                            <form action="<?php echo base_url();?>tools/sendMessage" method="post">
                                <input type="hidden" name="messageType" value="REWARD_PUBLIC"/>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Server</label>
                                    <div class="col-sm-10">
                                        <select name="server[]" class="selectpicker" data-live-search="true" multiple>
                                            <option value="all" selected>Tất cả</option>
                                            <?php foreach($serverList as $server){?>
                                                <option value="<?php echo $server->code;?>"><?php echo $server->code." - ".$server->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tiêu đề</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="title" value="">
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
                                    <label for="inputMapName" class="col-sm-2 control-label">Nội dung</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="form-control" rows="8"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Gói quà</label>
                                    <div class="col-sm-10">
                                        <select name="rewardId" class="selectpicker" data-live-search="true">
                                            <?php foreach($rewards as $reward){ if($reward->type != "REWARD_MAP"){?>
                                                <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                                            <?php }}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="button" id="save" class="btn btn-default">Gửi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="notify">
                            <form action="<?php echo base_url();?>tools/sendMessage" method="post" role="form">
                                <input type="hidden" name="messageType" value="EVENT_NOTICE"/>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Server</label>
                                    <div class="col-sm-10">
                                        <select name="server" class="selectpicker" data-live-search="true">
                                            <option value="all">Tất cả</option>
                                            <?php foreach($serverList as $server){?>
                                                <option value="<?php echo $server->code;?>"><?php echo $server->code." - ".$server->name;?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Tiêu đề</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="title" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label">Nội dung</label>
                                    <div class="col-sm-10">
                                        <textarea name="content" class="form-control" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMapName" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="button" id="save" class="btn btn-default">Gửi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div id="result"></div>
            </div>
        </div>
    </div>
</section>
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
<script src="<?php echo base_url();?>public/temp/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>public/temp/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>public/temp/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script>
    $(function() {
        $('.selectpicker').selectpicker();
        $("input[id^='datemask']").inputmask("datetime")

        $('button#save').on("click", function(){
            var form = $(this).closest("form");
            var formURL = form.attr("action");
            var postData = form.serializeArray();
            $.ajax({
                url : formURL,
                type: "POST",
                data : postData,
                success:function(data, textStatus, jqXHR)
                {
                    $("div#result").append(data);
//                    if(data=="success"){
//                        window.location.reload();
//                    }else{
//                        alert(data);
//                    }
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                    alert(textStatus);//if fails
                }
            });
        });
    });
</script>