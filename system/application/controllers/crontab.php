<?php

class crontab extends BaseController
{

    function __construct()
    {
        parent::__construct();
    }

    public function rewardTopSongDau()
    {
        $this->session->set_userdata("server_remote", "vl");
        $this->load->model("player_songdau_dao");
        $this->load->model("messagedao");
        $tops = $this->player_songdau_dao->findTop(100);
        //echo json_encode($listVip);
        $reward1_3 = array(
            "5848bbacef2081266291702f",
            "5848bbcdef20812662917030",
            "5848bbf2ef20812662917032"
        );

        $reward4_10 = "5848bc0fef20812662917034";
        $reward11_50 = "5848bc2cef20812662917035";
        $reward51_100 = "5848bc85ef20812662917038";

        $debug = array();
        $i = 0;

        $countTop = count($tops);
		$strLog = "";

        for ($i = 0; $i < 3; $i++) {
			
			if($i >= $countTop)
				break;
			
			$dataUser = explode("_", $tops[$i]->owner);
			$strLog .= ($i+1).".".$tops[$i]->owner." - ".$tops[$i]->pointWin."\n\r";
			
            $message = array(
                "messageType" => "REWARD",
                "title" => "Phần thưởng top " . ($i + 1) . " Song Đấu",
                "content" => "",
                "owner" => $tops[$i]->owner,
                "codeReward" => $reward1_3[$i],
                "createTime" => new MongoDate(),
                "endTime" => new MongoDate(DateUtil::getCurrentUnix() + 7 * 24 * 60 * 60),
                "server" => $dataUser[1],
                "status" => "PRIVATE",
            );
			
            $this->messagedao->saveMessage($message);
        }
		
		for ($i = 3; $i < 10; $i++) {
			
			if($i >= $countTop)
				break;
			
            $dataUser = explode("_", $tops[$i]->owner);
			$strLog .= ($i+1).".".$tops[$i]->owner." - ".$tops[$i]->pointWin."\n\r";
			
            $message = array(
                "messageType" => "REWARD",
                "title" => "Phần thưởng top " . ($i + 1) . " Song Đấu",
                "content" => "",
                "owner" => $tops[$i]->owner,
                "codeReward" => $reward4_10,
                "createTime" => new MongoDate(),
                "endTime" => new MongoDate(DateUtil::getCurrentUnix() + 7 * 24 * 60 * 60),
                "server" => $dataUser[1],
                "status" => "PRIVATE",
            );
			
            $this->messagedao->saveMessage($message);
        }
		
		for ($i = 10; $i < 50; $i++) {
			
			if($i >= $countTop)
				break;
			
            $dataUser = explode("_", $tops[$i]->owner);
			$strLog .= ($i+1).".".$tops[$i]->owner." - ".$tops[$i]->pointWin."\n\r";
			
            $message = array(
                "messageType" => "REWARD",
                "title" => "Phần thưởng top " . ($i + 1) . " Song Đấu",
                "content" => "",
                "owner" => $tops[$i]->owner,
                "codeReward" => $reward11_50,
                "createTime" => new MongoDate(),
                "endTime" => new MongoDate(DateUtil::getCurrentUnix() + 7 * 24 * 60 * 60),
                "server" => $dataUser[1],
                "status" => "PRIVATE",
            );
			
            $this->messagedao->saveMessage($message);
        }
		
		for ($i = 50; $i < 100; $i++) {
			
			if($i >= $countTop)
				break;
			
            $dataUser = explode("_", $tops[$i]->owner);
			$strLog .= ($i+1).".".$tops[$i]->owner." - ".$tops[$i]->pointWin."\n\r";
			
            $message = array(
                "messageType" => "REWARD",
                "title" => "Phần thưởng top " . ($i + 1) . " Song Đấu",
                "content" => "",
                "owner" => $tops[$i]->owner,
                "codeReward" => $reward51_100,
                "createTime" => new MongoDate(),
                "endTime" => new MongoDate(DateUtil::getCurrentUnix() + 7 * 24 * 60 * 60),
                "server" => $dataUser[1],
                "status" => "PRIVATE",
            );
			
            $this->messagedao->saveMessage($message);
        }
		
		$this->player_songdau_dao->resetPointWin();
        
        echo $strLog;
    }
	
	public function setTopBidding(){
		$this->session->set_userdata("server_remote", "vl");
		$config = $this->request(array("doc_type" => "CLAN_WAR_CONFIG"), "http://vl.ganetstudio.com/public/gmtool/get/base");
		$config = $config->cache_data[0];
		
		$this->load->model("log_bidding_castle_dao");
		$this->load->model("log_castle_dao");
		
		foreach($config->castles as $castle){
			
			foreach($config->clusters as $key => $value){
				
				$cluster = intval($key);
				$topBidding = $this->log_bidding_castle_dao->findTop1($cluster, $castle->id);
				
				if($topBidding != null){
					$logCastle = $this->log_castle_dao->findByClusterAndCastleId($cluster, $castle->id);
					if($logCastle != null){
						if(ValidateUtil::isEmpty($logCastle->clanId)){
							$logCastle->clanId = $topBidding->clanId;
						}
						else
						{
							$logCastle->clanAttack = $topBidding->clanId;
						}
						$this->log_castle_dao->save($logCastle);
					}
					else{
						$logCastle = $this->createDefaultLogCastle($cluster, $castle->id, $topBidding->clanId);
						$this->log_castle_dao->insertLog($logCastle);
						
					}
				}
			}
		}
		
		// $this->log_bidding_castle_dao->dropCollection();
	}
	
	public function logTopEventMidAutumn(){
		$this->session->set_userdata("server_remote", "vl");
		error_reporting(0);
		$this->load->model("log_event_midautumn_dao");
		$tops = $this->log_event_midautumn_dao->findTop();
		$str = "";
		$i = 1;
		foreach($tops as $top){
			$str .= $i . " - " . $top->owner . " - " .$top->point . " - " .DateUtil::formatTime($top->createTime->sec, 'd-m-Y H:i:s')."\n";
			$i++;
		}
		echo $str;
	}
	
	public function topEventMidAutumn(){
		$file = fopen(BASE_DIR.'/public/top_event_midautumn.cron.log','r');
		if ($file) {
			while (($line = fgets($file)) !== false) {
				echo $line."<br/>";
			}

			fclose($file);
		} else {
			echo "Sơn nó làm lỗi rồi!";
		} 
	}
	
	private function createDefaultLogCastle($cluster, $castleId, $clanId){
		$now = new MongoDate();
		$logCastle = array(
			"cluster" => $cluster,
			"castleId" => $castleId,
			"clanId" => $clanId,
			"clanAttack" => "",
			"minesLevel" => intval(1),
			"endTimeMines" => $now,
			"protectTime" => $now,
			"lastActiveMine" => $now,
			"resource" => 0,
			"turnActive" => 0,
			"docType" => "LOG_CASTLE",
		);
		return $logCastle;
	}
}