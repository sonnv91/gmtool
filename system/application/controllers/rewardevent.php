<?php

class RewardEvent extends CI_Controller
{

    private $datas;
    private $api;

    function __construct()
    {
        parent::__construct();
        $this->api = $this->config->item("api");
    }
	
	public function rewardTopChaos(){
		
		$this->session->set_userdata("server_remote", "vl");
		
		$this->load->model("player_chaos_dao");
		$this->load->model("messagedao");
		$this->load->model("log_top_dao");
		
		$tops = $this->player_chaos_dao->findTopChaos();
		$countTop = count($tops);
		$response = "";
		// echo json_encode($tops);echo count($tops);die;
		
		$topReward = array(
			"57d7baa0ef20810b8bfa7f86",
			"57d7baf9ef20810b8bfa7f89",
			"57d7bb29ef20810b8bfa7f8b",
			"57d7bb51ef20810b8bfa7f8d",
			"57d7bb51ef20810b8bfa7f8d",
			"57d7bb51ef20810b8bfa7f8d",
			"57d7bb51ef20810b8bfa7f8d",
			"57d7bb51ef20810b8bfa7f8d",
			"57d7bb51ef20810b8bfa7f8d",
			"57d7bb51ef20810b8bfa7f8d",
		);
		
		$logTops = array();
		// trao thuong top 10
		for($i=0;$i<10;$i++){
			if(isset($tops[$i])){
				$info = explode("_", $tops[$i]->owner);
				$message = array(
                    "messageType" => "REWARD",
                    "title" => "Phần thưởng top ".($i+1)." Đại hội võ lâm",
                    "content" => "",
                    "owner" => $tops[$i]->owner,
                    "codeReward" => $topReward[$i],
                    "createTime" => new MongoDate(),
                    "endTime" => new MongoDate(DateUtil::getCurrentUnix() + 7*24*60*60),
                    "server" => $info[1],
                    "status" => "PRIVATE",
                );
                $this->messagedao->saveMessage($message);		
				
				$topPlayer = (object)array(
					"owner" => $tops[$i]->owner,
					"point" => $tops[$i]->point
				);
				$logTops[] = $topPlayer;
			}
			$response .= ($i+1).".".$tops[$i]->owner."\t : \t".$tops[$i]->point."\r\n";
		}
		$this->log_top_dao->insertLog($logTops);
		
		// trao thuong cao, trung, so cap
		if($countTop > 10){
			for($i=10;$i<$countTop;$i++){
				$info = explode("_", $tops[$i]->owner);
				$rewardId = $this->getRewardId($tops[$i]->point);
				$title = $this->getTitle($tops[$i]->point);
				$message = array(
                    "messageType" => "REWARD",
                    "title" => $title,
                    "content" => "",
                    "owner" => $tops[$i]->owner,
                    "codeReward" => $rewardId,
                    "createTime" => new MongoDate(),
                    "endTime" => new MongoDate(DateUtil::getCurrentUnix() + 7*24*60*60),
                    "server" => $info[1],
                    "status" => "PRIVATE",
                );
                $this->messagedao->saveMessage($message);
				
				$response .= ($i+1).".".$tops[$i]->owner."\t : \t".$tops[$i]->point."\r\n";
			}
		}
		
		// $this->player_chaos_dao->resetPoint(0);
		echo $response;
	}
	
	public function resetPointChaos(){
		$this->session->set_userdata("server_remote", "vl");
		$this->load->model("player_chaos_dao");
		$this->player_chaos_dao->resetPoint(0);
	}
	
	// public function logChaosPoint(){
		// $from = DateUtil::toMongoDate('10-10-2016 00:00:00');
		// $to = DateUtil::toMongoDate('16-10-2016 22:00:00');
		// $this->load->model("log_chaos_point_dao");
		// $this->load->model("messagedao");
		// $response = $this->log_chaos_point_dao->logPoint($from, $to);
		// $array = array(
			// "91605743690_S13",
			// "91502571495_S8",
			// "91503211534_S5",
			// "91605582692_S11",
			// "91604947940_S5",
			// "91604792855_S5",
			// "91604914269_S5",
			// "91604803600_S5",
			// "91605582964_S11",
			// "91605477422_S9",
			// "91604873893_S5",
			// "91604775275_S5",
			// "91605583541_S11",
			// "91605748090_S13",
			// "91604868843_S5",
			// "91604868790_S5",
			// "91605281602_S6",
			// "91604786393_S1",
			// "91604814810_S1",
			// "91605901792_S17",
			// "91502487320_S17",
			// "91604952354_S8",
			// "91604991979_S1"
		// );
		// foreach($response["result"] as $p){
			// if(!in_array($p["_id"], $array)){
				// $info = explode("_", $p["_id"]);
				// $rewardId = $this->getRewardId($p["point"]);
				// $title = $this->getTitle($p["point"]);
				// $message = array(
                    // "messageType" => "REWARD",
                    // "title" => $title,
                    // "content" => "",
                    // "owner" => $p["_id"],
                    // "codeReward" => $rewardId,
                    // "createTime" => new MongoDate(),
                    // "endTime" => new MongoDate(DateUtil::getCurrentUnix() + 7*24*60*60),
                    // "server" => $info[1],
                    // "status" => "PRIVATE",
                // );
                // $this->messagedao->saveMessage($message);
			// }
		// }
	// }
	
	private function getRewardId($point){
		// qua so cap
		if($point >= 100 && $point < 300) return "57d7bd5fef20810b8bfa7fa4";
		
		// qua trung cap
		if($point >= 300 && $point < 500) return "57d7bd3eef20810b8bfa7fa2";
		
		// qua cao cap
		if($point >= 500) return "57d7bd28ef20810b8bfa7fa0";
	}
	
	private function getTitle($point){
		if($point >= 100 && $point < 300) return "Phần thưởng sơ cấp Đại hội võ lâm";
		
		if($point >= 300 && $point < 500) return "Phần thưởng trung cấp Đại hội võ lâm";
		
		if($point >= 500) return "Phần thưởng cao cấp Đại hội võ lâm";
	}
}