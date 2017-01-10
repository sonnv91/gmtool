<?php

class User extends BaseController
{

    function __construct()
    {
        parent::__construct();
        $this->datas["active_menu"] = __CLASS__;
        $this->load->model("playerdao");
        $this->load->library('pagination');
    }

    function index()
    {
        echo "ok";
    }

    function userlist()
    {
        $key = $this->uri->segment(3) ? urldecode($this->uri->segment(3)) : -1;
        $offset = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        if (isset($_POST["search_key"])) $key = $_POST["search_key"];
        $players = $this->playerdao->findListPlayer($key, $offset, RECORD_PER_PAGE);

        $config['base_url'] = site_url('user/list/' . $key);
        $config['total_rows'] = $this->playerdao->countAllPlayer($key);
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $this->datas["title"] = "Danh sách người chơi";
        $this->datas["sub"] = "user/list";
        $this->datas["data"] = array(
            "players" => $players,
            "pagination" => $this->pagination->create_links()
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function saveUser()
    {
        $request = getDataRequest("RequestPlayer", $_POST);
        //echo json_encode($request);die;
        $player = $this->playerdao->findById($request->id);

        $dataUpdate = $this->createDataUpdatePlayer($request, $player);
        //echo json_encode($dataUpdate);die;
        $this->playerdao->updateById($player->_id, $dataUpdate);

        redirect("/user/list/" . $player->owner . "/0");
    }
	
	public function banUser(){
		$this->load->model("user_dao");
		$request = getDataRequest("RequestPlayer", $_POST);
		httpGet(API_GAME."public/evict/".$request->id);
		$player = $this->playerdao->findById($request->id);
		$user = $this->user_dao->findByUsername($player->owner);
		$user->userStatus = "INACTIVE";
		echo json_encode($user);
		$this->user_dao->save($user);
		redirect("/user/list/" . $player->owner . "/0");
	}
	
	public function unban(){
		// $id = $_POST["id"];
		// $server = $_POST["server"];
		$username = $_POST["owner"];
		$this->load->model("user_dao");
		$this->user_dao->updateStatus($username, "ACTIVE");
		redirect("/user/list/" . $username . "/0");
	}

    private function getVip($vip)
    {
        $vips = $this->request(array("doc_type" => "VIP"), $this->api["gmtool_get_base"]);
        foreach ($vips->cache_data as $v) {
            if ($v->vip == $vip) return $v;
        }
        return false;
    }

    private function createDataUpdatePlayer($request, $player)
    {
        $current_vip = isset($player->vip) ? $player->vip : 0;
        $current_coin = isset($player->coin) ? $player->coin : 0;
        $current_silver = isset($player->silver) ? $player->silver : 0;
        $current_turn_boss = isset($player->turnBossFighting) ? $player->turnBossFighting : 0;
        $vipRequire = $this->getVip($request->vip);
        //$dayOfEventNewbie = (int)intval($request->dayOfEventNewbie) > 0;

        $coinRemain = $current_coin + $request->coin;
        $silverRemain = $current_silver + $request->silver;
        $turnBossFighting = $current_turn_boss + $request->turnBossFighting;

        $dataUpdate = array(
            "coin" => $coinRemain,
            "silver" => $silverRemain,
            "turnBossFighting" => $turnBossFighting
            //"dayOfEventNewbie" => $dayOfEventNewbie
        );

        //$unixLastLogin = $player->lastLogin->sec + (intval($request->passDay) * 86400);
        //$lastLogin = new MongoDate($unixLastLogin);
        //$dataUpdate["lastLogin"] = $lastLogin;

        if ($vipRequire->vip != $current_vip) {
            $dataUpdate["coinCharge"] = $vipRequire->coinRequire;
            $dataUpdate["vip"] = $vipRequire->vip;
        }

        return $dataUpdate;
    }
	
	public function topHS(){
		
		header('Content-Type: text/html; charset=utf-8');
		$this->load->model("playerdao");
		$data = $this->playerdao->findTopHoason("S20");
		
		$str1 = "";
		$str11 = "";
		
		$i = 1;
		foreach($data as $top1){
			//echo json_encode($top1->name);
			$str1 .= "$i. $top1->code -- $top1->name<br/>";
			$str11 .= "$i. $top1->code -- $top1->name -- $top1->rank \r\n";
			$i += 1;
		}
		
		echo $str1;
		
		$file = fopen(DIR_STRUCT_DATA."top_hs_s20.log","w");
		
		fwrite($file,$str11);
		fclose($file);
		
	}
	
	public function rankHS(){
		//S2(5000)-S3(?)-S6(5000)-S4, S1, S5
		$this->load->model("playerdao");
		for($i=1;$i<=28;$i++){
			$players = $this->playerdao->listPlayerHS("S".$i);
			$j = 1;
			foreach($players as $p){
				$this->playerdao->updateById($p->_id, array('rank' => $j));
				$j++;
			}
		}
	}
	
	public function topLevelAndMetaPower(){
		header('Content-Type: text/html; charset=utf-8');
		$this->load->model("playerdao");
		$topLevel = $this->playerdao->findTopLevel("S28");
		$topMetaPower = $this->playerdao->findTopMetaPower("S28");
		
		$str1 = "";
		$str11 = "";
		$str2 = "";
		$str22 = "";
		
		$i = 1;
		foreach($topLevel as $top1){
			//echo json_encode($top1->name);
			$str1 .= "$i. $top1->code -- $top1->name -- $top1->level <br/>";
			$str11 .= "$i. $top1->code -- $top1->name -- $top1->level \r\n";
			$i += 1;
		}
		
		$j=1;
		foreach($topMetaPower as $top2){
			$str2 .= "$j. $top2->code -- $top2->name -- $top2->metaPower <br/>";
			$str22 .= "$j. $top2->code -- $top2->name -- $top2->metaPower \r\n";
			$j += 1;
		}
		
		echo "Top level S28: <br/>";
		echo $str1."<br/>";
		echo "Top chien luc S28: <br/>";
		echo $str2;
		
		// $file1 = fopen(DIR_STRUCT_DATA."top_level_s20.log","w");
		
		// fwrite($file1,$str11);
		// fclose($file1);
		
		// $file2 = fopen(DIR_STRUCT_DATA."top_power_s20.log","w");
		
		// fwrite($file2,$str22);
		// fclose($file2);
	}
	
	public function level60(){
		header('Content-Type: text/html; charset=utf-8');
		$option_extra = $this->request(array("doc_type" => "OPTION_EXTRA"), $this->api["gmtool_get_base"]);
        $option_magic = $this->request(array("doc_type" => "OPTION_MAGIC"), $this->api["gmtool_get_base"]);
		// echo json_encode($option_extra);
		foreach($option_extra->cache_data as $opt){
			if(count($opt->equipmentType) > 0) echo json_encode($opt->equipmentType).",";
		}
	}
	
	public function tichluy(){
		$this->load->model("log_transaction_dao");
		$date = DateUtil::toMongoDate("16-07-2016 00:00:00");
		// echo json_encode($date);
		$data = $this->log_transaction_dao->fixCoinhoard($date);
		foreach($data["result"] as $log){
			echo $log["_id"]." - ".intval($log["coinHoard"])."<br/>";
			$player = $this->playerdao->findByPlayerCode($log["_id"]);
			$this->playerdao->updateCoinHoard((string)$player->_id,intval($log["coinHoard"]));
		}
	}
	public function tichluy2(){
		// $this->load->model("log_transaction_dao");
		// $this->load->model("messagedao");
		// $from = DateUtil::toMongoDate("16-07-2016 00:00:00");
		// $to = DateUtil::toMongoDate("17-07-2016 12:45:00");
		// $data = $this->log_transaction_dao->fixCoinhoard2($from,$to);
		// foreach($data["result"] as $log){
			// $server = explode("_", $log["_id"]);
                // $message = array(
                    // "messageType" => "REWARD",
                    // "title" => "Phần thưởng nạp tích lũy 2000KNB",
                    // "content" => "",
                    // "owner" => $log["_id"],
                    // "codeReward" => "561e333c3a16375b9100f27a",
                    // "createTime" => new MongoDate(),
                    // "endTime" => new MongoDate(DateUtil::getCurrentUnix() + 7*24*60*60),
                    // "server" => $server[1],
                    // "status" => "PRIVATE",
                // );
                // $this->messagedao->saveMessage($message);
		// }
	}
}