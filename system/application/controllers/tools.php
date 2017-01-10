<?php

class Tools extends BaseController{

    function __construct(){
        parent::__construct();
        $this->datas["active_menu"] = __CLASS__;
        $this->load->model("playerdao");
        $this->load->model("messagedao");
        $this->load->model("logbosssessiondao", "log_boss_session");
        $this->load->model("log_tongkim_session_dao", "log_tongkim_session");
    }

    public function viewSendMessage(){
        $reward = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);
        $server = $this->request(array("doc_type" => "SERVER"), $this->api["gmtool_get_base"]);
        $this->datas["sub"] = "tools/send_message";
        $this->datas["data"] = array(
            "title" => "Gửi tin nhắn",
            "rewards" => $reward->cache_data,
            "serverList" => $server->cache_data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function viewActivities(){
        $logBossSession = $this->log_boss_session->findLastestCollection();
        $logTongkimSession = $this->log_tongkim_session->findLastestCollection();
        $this->datas["sub"] = "tools/activities";
        $this->datas["data"] = array(
            "title" => "Hoạt động",
            "logBossSession" => $logBossSession,
            "logTongkimSession" => $logTongkimSession
        );
        //echo json_encode(new DateTime());die;
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function serverList(){
        $server = $this->request(array("doc_type" => "SERVER"), $this->api["gmtool_get_base"]);
		// echo json_encode($server->cache_data);die;
		usort($server->cache_data, "serverSort");
        $this->datas["sub"] = "tools/server_list";
        $this->datas["data"] = array(
            "title" => "Danh sách server",
            "serverList" => $server->cache_data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function saveServer(){
        $request = getDataRequest('RequestServer', $_POST);
        if(!preg_match("/^[a-zA-Z0-9]*$/",$request->code)){
            header("HTTP/1.0 404 Ma server khong hop le");die;
        }
        if(!ValidateUtil::validUrl($request->url)){
            header("HTTP/1.0 404 URL khong hop le");die;
        }
        $this->request($request, $this->api["gmtool_server_save"]);
    }

    public function startBoss(){
        // $server = $this->request(array("doc_type" => "SERVER"), $this->api["gmtool_get_base"]);
        // $countServer = count($server->cache_data);
        // $listBossSession = $this->log_boss_session->findListNewestCollection($countServer);
        // foreach($listBossSession as $bossSession){
            // if($bossSession->status == "WAITING"){
                // $now = new DateTime();
                // $createTime = new MongoDate($now->getTimestamp());
                // $endTime = new MongoDate($now->getTimestamp() + 15 * 60);
                // $bossSession->createTime = $createTime;
                // $bossSession->endTime = $endTime;
                // $this->log_boss_session->save($bossSession);
            // }
        // }
        // redirect('/tools/activities');
    }

    public function startTongkim(){
        // $server = $this->request(array("doc_type" => "SERVER"), $this->api["gmtool_get_base"]);
        // $countServer = count($server->cache_data);
        // $listTkSession = $this->log_tongkim_session->findListNewestCollection($countServer * 3);
        // foreach($listTkSession as $tkSession){
            // if($tkSession->status == "WAITING"){
                // $now = new DateTime();
                // $createTime = new MongoDate($now->getTimestamp());
                // $endTime = new MongoDate($now->getTimestamp() + 15 * 60);
                // $tkSession->createTime = $createTime;
                // $tkSession->endTime = $endTime;
                // $this->log_tongkim_session->save($tkSession);
            // }
        // }
        // redirect('/tools/activities');
		echo httpGet('http://dev.ganetstudio.com/public/cron/tk');
    }
	
	public function endTk(){
        
		echo httpGet('http://dev.ganetstudio.com/public/cron/end_tk');
    }
	
	public function startBossHK(){
		echo httpGet('http://dev.ganetstudio.com/public/cron/boss');
	}
	
	public function endBossHK(){
        
		echo httpGet('http://dev.ganetstudio.com/public/cron/end_boss');
    }

    public function sendMessage(){
        if(!isset($_POST["messageType"])) die("Invalid request");
        switch($_POST["messageType"]){
            case "SYSTEM":
                $this->createMessageSystem();
                break;
            case "ACTIVITY":
                $this->createMessageActivity();
                break;
            case "EVENT_NOTICE":
                $this->createMessageNotice();
                break;
            case "REWARD_PRIVATE":
                $this->createMessageRewardPrivate();
                break;
            case "REWARD_PUBLIC":
                $this->createMessageRewardPublic();
                break;
        }
    }

    public function errorCardView(){

        $this->load->config("game_config");
        $server = $this->request(array("doc_type" => "SERVER"), $this->api["gmtool_get_base"]);
        $this->datas["sub"] = "tools/error_card";
        $this->datas["data"] = array(
            "title" => "Thẻ lỗi",
            "serverList" => $server->cache_data
        );
        $this->load->view(TEMPLATE, $this->datas);

    }

    public function errorCard(){


    }
	
	public function test(){
		// header('Content-Type: text/html; charset=utf-8');
		// $this->load->model("log_transaction_dao");
		// $from = DateUtil::toMongoDate('31-05-2016 00:00:00');
		// $to = DateUtil::toMongoDate('31-05-2016 23:59:59');
		
		// $logs = $this->log_transaction_dao->listTranInRange($from, $to);
		// $total = 0;
		// foreach($logs as $log){
			// if($log->amount > 4500){
				// $log->amount /= 100;
				// echo json_encode($log);
			// }
			// $vnd = convertGosuCoinToVND($log->amount);
			// $total += $vnd;
		// }
		// echo product_price($total);
		$rewards = $this->request(array("doc_type" => "CLAN_WAR_CONFIG"), $this->api["gmtool_get_base"]);
		echo json_encode($rewards);
	}
	
	public function clanWarConfig(){
		if(isset($_POST) && count($_POST) > 0){
			$cluster = (object) array(
				"0" => array("S1","S2","S3","S4","S5","S6","S7","S8","S9","S10","S11","S12","S13","S14","S15"),
				"1" => array("S16","S17","S18","S19","S20","S21","S22","S23","S24","S25","S26","S27","S28","S29","S30","S31")
			);
			$request = array(
				"time_end_bidding" => implode("-", $_POST["time_end_bid"]),
				"time_start_war" => implode("-", $_POST["time_start_war"]),
				"time_battle" => intval($_POST["timeBattle"]),
				"cluster" => $cluster
			);
			
			$this->request($request, $this->api["gmtool_clan_war_save"]);
		}
		else
		{
			$config = $this->request(array("doc_type" => "CLAN_WAR_CONFIG"), $this->api["gmtool_get_base"]);
			$config = $config->cache_data[0];
			
			$timeEndBidding = explode("-",$config->timeEndBidding);
			$timeStartWar = explode("-",$config->timeStartWar);
			$this->datas["sub"] = "tools/clan_war_config";
			$this->datas["data"] = array(
				"title" => "Only Dương Monk",
				"config" => $config,
				"timeEndBidding" => $timeEndBidding,
				"timeStartWar" => $timeStartWar
			);
			
			// var_dump($this->datas["data"]["config"]->clusters->{0});die;

			$this->load->view(TEMPLATE, $this->datas);
		}
	}
	
	public function repayCoinGroupon(){
		// $this->load->model("log_coin_dao");
		// $this->load->model("playerdao");
		
		// $startDate = strtotime('2016-12-10 00:00:00');
		// $startDate = new MongoDate($startDate);
		// $data = $this->log_coin_dao->logCoinGroupon($startDate);
		
		// $response = $data["result"];
		// $str = "";
		// for($i=0;$i<count($response);$i++){
			// $uinfo = explode("_",$response[$i]["_id"]);
			// $player = $this->playerdao->findByOwner($uinfo[0]);
			
			// $coinRepay = round($response[$i]["totalCoin"] * -1 * 2 / 10);
			// $this->playerdao->updateCoin($player->_id, $coinRepay);
			
			// echo $player->name." (".$player->code.") : ".$response[$i]["totalCoin"]." : ".$coinRepay."<br/>";
		// }
		
	}

    private function createMessageRewardPrivate(){
        $listOwner = explode("\n", $_POST["owner"]);
        //var_dump($listOwner);die;
        if(count($listOwner) <  1) die("Invalid request");

        foreach($listOwner as $owner){
            $player = $this->playerdao->findByPlayerCode($owner);
            if($player != null){
                $server = explode("_", $player->code);
                $message = array(
                    "messageType" => "REWARD",
                    "title" => $_POST["title"],
                    "content" => $_POST["content"],
                    "owner" => $owner,
                    "codeReward" => isset($_POST["rewardId"]) && $_POST["rewardId"] != -1 ? $_POST["rewardId"] : null,
                    "createTime" => new MongoDate(),
                    "endTime" => new MongoDate(DateUtil::getCurrentUnix() + 7*24*60*60),
                    "server" => $server[1],
                    "status" => "PRIVATE",
                );
                $this->messagedao->saveMessage($message);
                echo "Gửi quà thành công : TK: ".$player->owner." - NV: ".$player->name." - SV: ".$player->server."<br/>";
            }else{
                echo $owner." : tài khoản không đúng <br/>";
            }
        }
    }

    private function createMessageRewardPublic(){
        if(count($_POST["server"]) <  1) die("Invalid request");
        $createTime = $_POST["createTime"].":00";
        $endTime = $_POST["endTime"].":59";
        if(!ValidateUtil::validFormatTime($createTime) || !ValidateUtil::validFormatTime($endTime)) die("Định dạng ngày tháng không đúng <br/>");

        foreach($_POST["server"] as $server){
            $message = array(
                "messageType" => "REWARD",
                "title" => $_POST["title"],
                "content" => $_POST["content"],
                "codeReward" => isset($_POST["rewardId"]) && $_POST["rewardId"] != "" ? $_POST["rewardId"] : null,
                "createTime" => DateUtil::toMongoDate($createTime),
                "endTime" => DateUtil::toMongoDate($endTime),
                "server" => $server,
                "status" => "PUBLIC",
            );
            $this->messagedao->saveMessage($message);
            echo "Gửi quà thành công cho server : ".$server."<br/>";
        }
    }

    private function createMessageSystem(){
        $message = array(
            "messageType" => "SYSTEM",
            "title" => $_POST["title"],
            "content" => $_POST["content"],
            "server" => $_POST["server"],
            "status" => "PUBLIC",
        );
        $this->messagedao->saveMessage($message);
        echo "Gửi tin nhắn hệ thống thành công cho server : ".$_POST["server"]."<br/>";
    }

    private function createMessageNotice(){
        $message = array(
            "messageType" => "EVENT_NOTICE",
            "title" => $_POST["title"],
            "content" => $_POST["content"],
            "server" => $_POST["server"],
            "status" => "PRIVATE",
        );
        $this->messagedao->saveMessage($message);
        echo "Lưu công cáo thành công cho server : ".$_POST["server"]."<br/>";
    }

    private function createMessageActivity(){
        $message = array(
            "messageType" => "ACTIVITY",
            "title" => $_POST["title"],
            "content" => $_POST["content"],
            "server" => $_POST["server"],
            "status" => "PUBLIC",
        );
        $this->messagedao->saveMessage($message);
        echo "Lưu tin nhắn hoạt động thành công cho server : ".$_POST["server"]."<br/>";
    }
}