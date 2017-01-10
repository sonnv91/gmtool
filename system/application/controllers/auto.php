<?php

class auto extends BaseController{

    function __construct(){
        parent::__construct();
    }

    public function coinHoard(){
		die;
        $this->load->model("playerdao");
        $this->load->model("messagedao");
        $listVip = $this->playerdao->findListVip("S6");
        //echo json_encode($listVip);
        $reward = array(
            "56ebdc71aa22781ca52bc670",
            "56ebdca7aa22781ca52c01e5",
            "56ebdd96aa22781ca52d1178",
            "56ebdde4aa22781ca52d6246",
            "56ebde07aa22781ca52d86e6",
        );
        $debug = array();
        for($i = 0; $i < 5; $i++){
            foreach($listVip as $user){
                if($user->vip >= ($i + 1)){
                    $message = array(
                        "messageType" => "REWARD",
                        "title" => "Phần thưởng tích lũy VIP".($i+1),
                        "content" => "",
                        "owner" => $user->code,
                        "codeReward" => $reward[$i],
                        "createTime" => new MongoDate(),
                        "endTime" => new MongoDate(DateUtil::getCurrentUnix() + 7*24*60*60),
                        "server" => "S6",
                        "status" => "PRIVATE",
                    );

                    //if($user->vip == 5) $debug[] = $message;
                    $this->messagedao->saveMessage($message);
                }
            }
        }
        echo json_encode($debug);
    }
	
	public function rewardTopWord(){
		header('Content-Type: text/html; charset=utf-8');
		$this->load->model("playerdao");
        $this->load->model("messagedao");
        $this->load->model("log_word_answer_dao");
		
		$reward = array(
			"56c539634e694572e76c15ba",
			"56c539934e694572e76c15c6",
			"56c53a114e694572e76c15e1",
			"56e63fb3aa22786c51c2264a",
			"56c53a474e694572e76c15ed",
			"56c53ad04e694572e76c1609",
			"56c53aec4e694572e76c1611",
			"56c53b164e694572e76c1619",
			"56c53b2f4e694572e76c1622",
			"56c53b434e694572e76c1626",
		);
		$listServer = array("S1","S2","S3","S4","S5","S6","S7","S8","S9","S10","S11","S12","S13","S15","S15","S16","S17","S18","S19","S20","S21","S22","S23","S24");
		foreach($listServer as $server){
			$tops = $this->log_word_answer_dao->findTop($server);
			$i = 1;
			foreach($tops as $top){
				$player = $this->playerdao->findByPlayerCode($top->owner);
				echo $i.".".$player->name."<br/>";
				$message = array(
							"messageType" => "REWARD",
							"title" => "Phần thưởng top ".($i)." đoán chữ",
							"content" => "",
							"owner" => $top->owner,
							"codeReward" => $reward[$i-1],
							"createTime" => new MongoDate(),
							"endTime" => new MongoDate(DateUtil::getCurrentUnix() + 7*24*60*60),
							"server" => $server,
							"status" => "PRIVATE",
						);
				$i++;
				$this->messagedao->saveMessage($message);
			}
		}
	}
	public function shitItem(){
		// die("sss");
		$options = array(
			"5532376799116012ca23e4af", //khang bang
			"5532376799116012ca23e4b1", // khang hoa
			"5532376799116012ca23e4b0", // khang loi
			"55d2b3c88aa21874fe1dca24", //khang vat ly
			"5532376799116012ca23e4ae" //khang doc
		);
		$this->load->model("itemdao");
		$items = $this->itemdao->shitItem("_S7","55b8a5c59911601263fee456");
		// echo json_encode($items);die;
		$owners = array();
		foreach($items as $item){
			$i = 0;
			if(isset($item->options)){
				foreach($item->options as $opt){
					if(in_array($opt["parent"], $options)){
						$i += 1;					
					}
				}
			}
			if($i >= 2){
				echo $item->_id."<br/>";
			} 
		}
		// echo "a";
	}
	
	public function gendata(){
		// $file_perm = DIR_STRUCT_DATA."shititem.txt";
		// $file = fopen($file_perm, "r");
		// $this->load->model("itemdao");
		// $options_resist = array(
			// "5532376799116012ca23e4af",
			// "5532376799116012ca23e4b1",
			// "5532376799116012ca23e4b0",
			// "55d2b3c88aa21874fe1dca24",
			// "5532376799116012ca23e4ae"
		// );
		// $vkl =0;
		// while(! feof($file))
		// {
			// $id = fgets($file);
			// $id = trim($id);
			// $item = $this->itemdao->findById($id);
			// $count = 0;
			
			// if(isset($item->options)){
				// foreach($item->options as $key => $value){
					// if(in_array($value["parent"], $options_resist)){
						// $count += 1;					
					// }
					// if($count == 2){
						// unset($item->options[$key]);
						// break;
					// }
				// }
				// $newOpt = array();
				// foreach($item->options as $opt){
					// $newOpt[] = $opt;
				// }
				// $item->options = $newOpt;
				// $this->itemdao->save($item);
				// echo json_encode($item);
			// }
		// }
		// fclose($file);
	}
	public function test(){
		header('Content-Type: text/html; charset=utf-8');
		$rewards = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);
		foreach($rewards->cache_data as $reward){
			if($reward->exp[1] > 4000000){
				echo $reward->name . " => exp : ". $reward->exp[0] ." -> ".$reward->exp[1]."<br/>";
			}
		}
	}
	
	public function gendataShop(){
		header('Content-Type: application/json; charset=utf-8');
		$datas = array();
		
		for($i=0;$i<20;$i++){
			$objectId = new MongoId();
			$item = (object) array(
				"@class" => "bussiness.entity.ItemEntity",
				"id" => (string)$objectId,
				"docType" => "USABLE_ITEM",
				"parent" => "5698c6bd4e69453c11dc4e53",
				"quantity" => 1,
				"quality" => "PURPLE",
				"equipped" => false,
				"level" => 0,
				"levelUpgrade" => 0,
				"metaPower" => 0,
				"luckyPoint" => 0
			);
			$product = array(
				"@class" => "bussiness.entity.party.advanced.PartyAdvancedProduct",
				"id" => (string)$objectId,
				"docType" => "PARTY_ADVANCED_PRODUCT",
				"item" => $item,
				"price" => rand(100,1000)
			);
			$datas[] = $product;
		}
		echo json_encode($datas);
	}
	
	public function bugTrans(){
		$this->load->model('log_transaction_dao');
		$logs = $this->log_transaction_dao->bugOrderId();
		$owners = array();
		foreach($logs['result'] as $log){
			$bug = $this->log_transaction_dao->findByOrderId($log['_id']);
			if(!in_array($bug->owner, $owners)){
				$owners[] = $bug->owner;
			}
		}
		echo json_encode($owners);
	}
	
	public function passFullMap(){
		$this->load->model("log_map_complete_dao");
		$time = time() - 86400;
		$maps = $this->request(array("doc_type" => "MAP"), $this->api["gmtool_get_base"]);
		$listMap = $maps->cache_data;
		usort($listMap, "mapSort");
		foreach($listMap as $map){
			$time += 100;
			$data = (object) array(
				"className" => "bussiness.entity.log.LogMapCompleteEntity", 
				"owner" => "91605776135_S7", 
				"mapId" => $map->id, 
				"createTime" => new MongoDate($time), 
				"timeKillBoss" => 50000, 
				"server" => "S7", 
				"docType" => "LOG_MAP_COMPLETE"
			);
			$this->log_map_complete_dao->save($data);
			// echo json_encode($data);
		}
	}
	
	public function bugCHP(){
		header('Content-Type: text/html; charset=utf-8');
		$this->load->model("clandao");
		$this->load->model("itemdao");
		$this->load->model("playerdao");
		$clan = $this->clandao->findById("575b82bacfb297343c546dfe");
		// echo json_encode($clan->members);
		
		foreach($clan->members as $mem){
			$chp4 = $this->itemdao->findByOwnerAndParent($mem["owner"], "566550e1d9b38b266e2a57d8");
			$player = $this->playerdao->findByPlayerCode($mem["owner"]);
			// echo json_encode($chp4);
			echo $mem["owner"]." >> ".$player->name."(VIP$player->vip) >> ".$chp4->quantity."<br/>";
		}
	}
	
	public function bugCHP2(){
		header('Content-Type: text/html; charset=utf-8');
		$this->load->model("clandao");
		$this->load->model("itemdao");
		// $this->load->model("playerdao");
		$this->load->model("characterdao");
		$clan = $this->clandao->findById("575b82bacfb297343c546dfe");
		// echo json_encode($clan->members);
		
		foreach($clan->members as $mem){
			$character = $this->characterdao->findMain($mem["owner"]);
			$qtt = 0;
			foreach($character->frame as $frame){
				$item = $this->itemdao->findById($frame);
				if($item->levelUpgrade >= 8) $qtt += 1;
			}
			echo $mem["owner"]." >> ".$qtt."<br/>";
		}
	}
	
	public function topLevelAndMetaPower(){
		die;
		header('Content-Type: text/html; charset=utf-8');
		$this->load->model("playerdao");
		$topLevel = $this->playerdao->findTopLevel("S20");
		$topMetaPower = $this->playerdao->findTopMetaPower("S20");
		
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
		
		echo "Top level S20: <br/>";
		echo $str1."<br/>";
		echo "Top chien luc S20: <br/>";
		echo $str2;
		
		$file1 = fopen(DIR_STRUCT_DATA."top_level_s20.log","w");
		
		fwrite($file1,$str11);
		fclose($file1);
		
		$file2 = fopen(DIR_STRUCT_DATA."top_power_s20.log","w");
		
		fwrite($file2,$str22);
		fclose($file2);
	}
	
	public function topHS(){
		die;
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
	
	public function configHT(){
		$datas = $this->request(array("doc_type" => "MATERIAL"), $this->api["gmtool_get_base"]);
		$materials = array();
		$group = array();
		foreach($datas->cache_data as $material){
			if(isset($material->optionId)){
				$group[$material->optionId][] = $material;
			}
		}
		$response = array();
		foreach($group as $g){
			usort($g,"mapSort");
			$ids = array();
			foreach($g as $val){
				$ids[] = $val->id;
			}
			$response[$g[0]->optionId] = $ids;
		}
		echo json_encode($response);
	}
	
	public function saveConfigHt(){
		// $response = $this->request(array("doc_type" => "HUYENTINH_CONFIG"), $this->api["gmtool_get_base"]);
		// $data = $response->cache_data[0];
		$data = json_decode(file_get_contents(DIR_STRUCT_DATA."huyentinh_config.json"));
		// echo json_encode($data);
		$request = array(
			"huyentinh" => $data->huyentinh,
			"map_stones" => $data->mapStone,
			"material_combine" => $data->materialCombine,
			"material_socket" => $data->materialSocket,
			"material_socket_req" => $data->materialSocketReq,
			"default_option_id" => $data->defaultOptionId,
			"rate_socket" => $data->rateSocket,
			"rate_upgrade_ht" => $data->rateUpgradeHt,
			"rate_upgrade_stone" => $data->rateUpgradeStone,
			"range_value_option_stone" => $data->rangeValueOptionStone,
			"range_value_option_ht" => $data->rangeValueOptionHt
		);
		// echo json_encode($request);
		$this->request($request, $this->api["gmtool_huyentinh_save"]);
	}
	
	public function bugKinhmach(){
		$idMachs = array(
			"5757cbb8300ac0200200002b",
			"5757cbb8300ac0200200002c",
			"5757cbb8300ac0200200002d",
			"5757cbb8300ac0200200002e",
			"5757cbb8300ac0200200002f",
			"5757cbb8300ac02002000030",
			"5757cbb8300ac02002000031",
			"5757cbb8300ac02002000032"
		);
		
		foreach($idMachs as $id){
			$post = array(
				'owner' => '91605808548_S17',
				'id_kinh_mach' => $id,
				'idx_floor' => 3,
				'idx_mach' => 10
			);
			$this->request($post, 'http://dev.ganetstudio.com/public/util/dec_kinhmach');
		}
	}
}