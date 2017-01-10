<section class="content-header">
    <h1><?php echo $title;?></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-3">
            <div class="box">
                <form method="post">
                    <div class="form-group">
                        <label>Server:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-server"></i>
                            </div>
                            <select name="server" class="form-control">
                                <?php foreach($serverList as $server){?>
                                <option value="<?php echo $server->code?>" <?php if($server->code === $currentServer){echo 'selected="selected"';}?>><?php echo $server->name." - ".$server->code;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="datatable">
                        <thead>
                            <tr>
                                <th>Top</th>
                                <th>Tên bang hội</th>
                                <th>Bang chủ</th>
                                <th>Damage boss</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;foreach($tops as $top){?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td id="clan_name"><?php echo $top->clanName;?></td>
                                <td id="boss_name"><?php echo $top->clanMaster;?></td>
                                <td><?php echo $top->damage;?></td>
                                <td><button id="view" type="button" data="<?php echo $top->clanId;?>" class="btn btn-primary" data-loading-text="Loading...">Xem thành viên bang</button></td>
                            </tr>
                            <?php $i++;}?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box" id="clan_info" style="display: none">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" id="datatable">
                        <thead>
                            <tr style="color: #0000ff";>
                                <th id="clan_name" align="center" colspan="4">Tham Du Bang</th>
                            </tr>
                            <tr>
                                <th>Tên đăng nhập</th>
                                <th>Tên nhân vật</th>
                                <th>Level</th>
                                <th>Vip</th>
                                <th>KNB</th>
                            </tr>
                            </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <form class="form-horizontal" action="<?php echo base_url();?>event/clan_boss/reward" method="post">
                    <div class="form-group">
                        <label class="col-sm-2 ">Top nhận thưởng</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="top" value="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 ">Top 1 Master</label>
                        <select name="rewardMasterTop1" class="selectpicker" data-live-search="true">
                            <?php foreach($rewards as $reward){ if($reward->type != "REWARD_MAP"){?>
                                <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                            <?php }}?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 ">Top 1 Member</label>
                        <select name="rewardMemTop1" class="selectpicker" data-live-search="true">
                            <?php foreach($rewards as $reward){ if($reward->type != "REWARD_MAP"){?>
                                <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                            <?php }}?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 ">Top 2 Master</label>
                        <select name="rewardMasterTop2" class="selectpicker" data-live-search="true">
                            <?php foreach($rewards as $reward){ if($reward->type != "REWARD_MAP"){?>
                                <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                            <?php }}?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 ">Top 2 Member</label>
                        <select name="rewardMemTop2" class="selectpicker" data-live-search="true">
                            <?php foreach($rewards as $reward){ if($reward->type != "REWARD_MAP"){?>
                                <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                            <?php }}?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 ">Top 3 Master</label>
                        <select name="rewardMasterTop3" class="selectpicker" data-live-search="true">
                            <?php foreach($rewards as $reward){ if($reward->type != "REWARD_MAP"){?>
                                <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                            <?php }}?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 ">Top 3 Member</label>
                        <div class="col-sm-10">
                            <select name="rewardMemTop3" class="selectpicker" data-live-search="true">
                                <?php foreach($rewards as $reward){ if($reward->type != "REWARD_MAP"){?>
                                    <option value="<?php echo $reward->id;?>"><?php echo $reward->name;?></option>
                                <?php }}?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <button id="reward" type="button" class="btn btn-primary" data-loading-text="Loading...">Trao thưởng</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo base_url();?>public/temp/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url();?>public/temp/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>public/temp/js/bootstrap-select.min.js" type="text/javascript"></script>
<script>
    $(function () {
        //$('#reservation').daterangepicker();
		$('.selectpicker').selectpicker();
        $('select[name="server"]').on('change', function(){
           $(this).closest('form').submit();
        });
    });
</script>
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
    $(document).on('click', '#view', function(){
        var clanId = $(this).attr('data');
        var clanname = $(this).parent().parent().find('td[id="clan_name"]').html()
        var bossname = $(this).parent().parent().find('td[id="boss_name"]').html()
        $.ajax({
            url : "<?php echo base_url();?>api/clan/info",
            type: "POST",
            data : {
                clanId : clanId
            },
            beforeSend: function( xhr ) {
                //$(this).button('loading')
            },
            success:function(data, textStatus, jqXHR)
            {
                var info = jQuery.parseJSON(Base64.decode(data))
                $("#clan_info").show()
                var tbody = $("#clan_info").find('tbody')
                tbody.empty()
                $("#clan_info").find('#clan_name').html(clanname)

                for(i = 0; i < info.length; i++){
                    var style = '';
                    if(info[i].name == bossname){
                        style = ' style="color:red"';
                    };
                    var html = '<tr'+style+'><td>'+info[i].owner+'</td><td>'+info[i].name+'</td><td>'+info[i].level+'</td><td>'+info[i].vip+'</td><td>'+info[i].coin+'</td></tr>'
                    tbody.append(html)
                }
                //alert(info)
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(errorThrown);
            }
        });
    });
	$("#reward").on("click", function(){
		var formURL = $(this).closest("form").attr("action");
		var postData = $(this).closest("form").serializeArray();
		var save_btn = $(this).closest("form").find('button#reward')
		$.ajax({
            url : formURL,
            type: "POST",
            data : postData,
            beforeSend: function( xhr ) {
                save_btn.button('loading')
            },
            success:function(data, textStatus, jqXHR)
            {
                alert("Reward success")
                save_btn.button('reset')
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert(errorThrown);//if fails
                save_btn.button('reset')
            }
        });
	})
</script>