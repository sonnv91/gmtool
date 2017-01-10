<?php
    class Event extends BaseController{

        function __construct(){
            parent::__construct();
            $this->datas["active_menu"] = __CLASS__;
            $this->load->model('event_dao');
        }

        public function config(){
            $listEvent = $this->event_dao->findListNewestCollection();
            $now = DateUtil::getCurrentUnix();
            $listServer = $this->request(array("doc_type" => "SERVER"), $this->api["gmtool_get_base"]);
            $this->datas["sub"] = "event/config";
            $this->datas["data"] = array(
                "title"     => "Sự kiện",
                "listEvent" => $listEvent,
                "listServer" => $listServer->cache_data,
                "now"       => $now
            );
            $this->load->view(TEMPLATE, $this->datas);
        }

        public function coinHoardConfig(){

            $configs = $this->request(array("doc_type" => "EVENT_COIN_HOARD"), $this->api["gmtool_get_base"]);
            $rewards = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);

            //echo json_encode($configs->cache_data);die;
            $this->datas["sub"] = "event/hoard_config";
            $this->datas["data"] = array(
                "title" => "Nạp tich lũy",
                "configs" => $configs->cache_data,
                "rewards" => $rewards->cache_data
            );
            $this->load->view(TEMPLATE, $this->datas);
        }

        public function hoard(){
            $config = $this->request(array("doc_type" => "EVENT_COIN_HOARD", "id" => COIN_HOARD), $this->api["gmtool_get_entity"]);
            $reward = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);
            $this->datas["sub"] = "event/hoard";
            $this->datas["data"] = array(
                "title" => "Nạp xu nhận quà",
                "config" => $config->entity,
                "rewards" => $reward->cache_data
            );
            $this->load->view(TEMPLATE, $this->datas);
        }

        public function hoardDaily(){
            $config = $this->request(array("doc_type" => "EVENT_COIN_HOARD", "id" => COIN_HOARD_DAILY), $this->api["gmtool_get_entity"]);
            $rewards = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);
            $this->datas["sub"] = "event/coin_hoard_daily";
            $this->datas["data"] = array(
                "title" => "Nạp xu tích lũy",
                "config" => $config->entity,
                "rewards" => $rewards->cache_data
            );
            $this->load->view(TEMPLATE, $this->datas);
        }

        public function eventExchange(){
            $config = $this->request(array("doc_type" => "EVENT_EXCHANGE"), $this->api["gmtool_get_base"]);
            $rewards = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);
            $materials = $this->request(array("doc_type" => "MATERIAL"), $this->api["gmtool_get_base"]);
            $usableItems = $this->request(array("doc_type" => "USABLE_ITEM"), $this->api["gmtool_get_base"]);

            $this->datas["sub"] = "event/exchange";

            foreach($materials->cache_data as $material){
                $dmaterials[$material->id] = $material->name;
            }
			foreach($usableItems->cache_data as $usableItem){
                $dusableItem[$usableItem->id] = $usableItem->name;
            }
            $this->datas["data"] = array(
                "title" => "Sự kiện đổi vật phẩm",
                "config" => $config->cache_data[0],
                "rewards" => $rewards->cache_data,
                "materials" => $dmaterials,
                "usableItems" => $dusableItem,
                "usableItems2" => $usableItems->cache_data
            );
            $this->load->view(TEMPLATE, $this->datas);
        }

        public function groupon(){
            $config = $this->request(array("doc_type" => "PRODUCT_GROUPON"), $this->api["gmtool_get_base"]);
			// echo json_encode($config);die;
            $baseItem = $this->get($this->api["gmtool_get_base_item"]);
            $materials = $this->request(array("doc_type" => "MATERIAL"), $this->api["gmtool_get_base"]);
            $usableItems = $this->request(array("doc_type" => "USABLE_ITEM"), $this->api["gmtool_get_base"]);

            $items = array();
            foreach($usableItems->cache_data as $usableItem){
                $items[] = $usableItem;
            }

            foreach($materials->cache_data as $material){
                $items[] = $material;
            }

            $this->datas["sub"] = "event/groupon";
            $this->datas["data"] = array(
                "title" => "Mua chung",
                "config" => $config->cache_data,
                "items" => $items,
                "staticItems" => $baseItem->cache_data
            );

            //echo json_encode($this->datas);die;
            $this->load->view(TEMPLATE, $this->datas);
        }
		
		public function midautumn(){
			$config = $this->request(array("doc_type" => "EVENT_MIDAUTUMN"), $this->api["gmtool_get_base"]);
			$materials = $this->request(array("doc_type" => "MATERIAL"), $this->api["gmtool_get_base"]);
            $usableItems = $this->request(array("doc_type" => "USABLE_ITEM"), $this->api["gmtool_get_base"]);
            $rewards = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);
			
			$this->load->model("log_event_midautumn_dao");
			$tops = $this->log_event_midautumn_dao->findTop();
			
			foreach($materials->cache_data as $material){
                $dmaterials[$material->id] = $material->name;
            }
			foreach($usableItems->cache_data as $usableItem){
                $dusableItem[$usableItem->id] = $usableItem->name;
            }
			
			$this->datas["sub"] = "event/midautumn";
            $this->datas["data"] = array(
                "title" => "Trung thu",
                "config" => $config->cache_data[0],
                "materials" => $dmaterials,
                "usableItems" => $dusableItem,
                "usableItems2" => $usableItems->cache_data,
                "rewards" => $rewards->cache_data,
				"tops"	=> $tops
            );

            // echo json_encode($this->datas);die;
            $this->load->view(TEMPLATE, $this->datas);
		}
		
		public function saveMidAutumnConfig(){
			$itemExchanges = array();
            for($i = 0; $i < count($_POST["point"]); $i++){

                $quantity = array();
                foreach($_POST["materials-".$i] as $materialId){
                    $quantity[] = intval($_POST["quantity-".$i."-".$materialId]);
                }
                $itemExchange = (object)array(
                    "materials" => $_POST["materials-".$i],
                    "quantity" => $quantity,
                    "item" => $_POST["item-".$i],
                    "point" => intval($_POST["point"][$i])
                );

                $itemExchanges[] = $itemExchange;
            }
            $_POST["item_exchanges"] = $itemExchanges;
            $_POST["max_turn"] = intval($_POST["max_turn"]);
            $_POST["point_advanced"] = array_map('intval', explode(',', $_POST["point_advanced"]));;

            $request = getDataRequest("RequestMidAutumnConfig", $_POST);
            // echo json_encode($request);die;
            $this->request($request, $this->api["gmtool_event_midautumn_save"]);
		}

        public function saveGrouponConfig(){

            $request = getDataRequest("RequestGroupon", $_POST);
            $conf = explode("-",$request->item);
            $item = $this->request(array("id" => $conf[0], "doc_type" => $conf[1]), $this->api["gmtool_get_entity"]);
            $quantity = intval($_POST["quantity"]);

            if($conf[1] === "BASE_STATIC_ITEM"){
                $item->entity->item->quantity = $quantity;
                $request->item = $item->entity->item;
            }else{
                $request->item = (object)array(
                    "@class"    => "bussiness.entity.ItemEntity",
                    "id"        => new MongoId(),
                    "docType"   => $item->entity->docType,
                    "parent"    => $item->entity->id,
                    "quantity"  => $quantity,
                    "quality"   => $item->entity->quality
                );
				
				if(isset($item->entity->level))
					$request->item->level = $item->entity->level;
            }
            $this->request($request, $this->api["gmtool_event_groupon_save"]);
        }

        public function saveEventExchange(){

            $itemExchanges = array();
            for($i = 0; $i < count($_POST["point"]); $i++){

                $quantity = array();
                foreach($_POST["materials-".$i] as $materialId){
                    $quantity[] = intval($_POST["quantity-".$i."-".$materialId]);
                }
                $itemExchange = (object)array(
                    "materials" => $_POST["materials-".$i],
                    "quantity" => $quantity,
                    "item" => $_POST["item-".$i],
                    "point" => intval($_POST["point"][$i])
                );

                $itemExchanges[] = $itemExchange;
            }
            $_POST["item_exchanges"] = $itemExchanges;

            $request = getDataRequest("RequestEventExchange", $_POST);
            //echo json_encode($request);die;
            $this->request($request, $this->api["gmtool_event_exchange_save"]);
        }


        public function saveCoinHoardConfig(){
            $request = getDataRequest('RequestCoinHoardConfig', $_POST);
            $this->request($request, $this->api["gmtool_coin_hoard_save"]);
        }

        public function eventClanBoss(){
            $server = isset($_POST["server"]) ? str_replace(" ","",$_POST["server"]) : "S1";
            $serverList = $this->request(array("doc_type" => "SERVER"), $this->api["gmtool_get_base"]);
            usort($serverList->cache_data, 'serverSort');

            $this->load->model("log_event_clan_boss_dao");
            $this->load->model("playerdao");
            $this->load->model("clandao");
            $result = $this->log_event_clan_boss_dao->getTopClanBoss($server, 10);
            //$eventList = $this->event_dao->findListEventEndedToReward('CLAN_BOSS');
            $rewards = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);
            $tops = array();

            if(isset($result["result"])){
                foreach($result["result"] as $res){
                    $clan = $this->clandao->findById($res["_id"]);
                    $masterOfClan = $this->playerdao->findByPlayerCode($clan->owner);

                    $dto = (object)array(
                        'clanId' => $res["_id"],
                        'clanName' => $clan->name,
                        'clanMaster' => $masterOfClan->name,
                        'damage' => $res["damage"]
                    );
                    $tops[] = $dto;
                }
            }
            //echo json_encode($top);die;
            $this->datas["sub"] = "event/clan_boss";
            $this->datas["data"] = array(
                "title" => "Sự kiện boss bang",
                "serverList" => $serverList->cache_data,
                "rewards"   => $rewards->cache_data,
                "tops" => $tops,
                "currentServer" => $server
            );
            $this->load->view(TEMPLATE, $this->datas);
        }

        public function saveConf(){

            $request = getDataRequest("RequestEventConfig", $_POST);

            if(ValidateUtil::isEmpty($request->_id)){
                $eventActive = $this->event_dao->findEventActiveByType($request->eventType, $request->server);
                if(count($eventActive) > 0){
                    header("HTTP/1.0 404 Su kien nay dang dien ra tren server ".$eventActive->server."! Khong the tao them!");
                    die;
                }
            }
            if(!isset($request->eventType)){
                header("HTTP/1.0 404 missing event type!");
                die;
            }

            $from = DateUtil::getCurrentTime($request->createTime.":59");
            $to = DateUtil::getCurrentTime($request->endTime.":59");
            $request->createTime = DateUtil::toMongoDate($from);
            $request->endTime = DateUtil::toMongoDate($to);

            $to = str_replace("/","-",$to);
            $request->maintainTime = $request->eventType == "GROUPON" ? new MongoDate(strtotime($to) + 24 * 60 *60) : $request->endTime;
            if(!ValidateUtil::isEmpty($request->_id)) $request->_id = new MongoId($request->_id);

            $this->event_dao->save($request);
            $event = $this->event_dao->findEventByType($request->server, $request->eventType);

            $this->request(array('id' => (string)$event->_id), $this->api["gmtool_event_save"]);
        }
		
		public function reloadEvent(){
			$listEvent = $this->event_dao->findListNewestCollection();
			// echo json_encode($listEvent);die;
			foreach($listEvent as $event){
				$this->request(array('id' => (string)$event->_id), $this->api["gmtool_event_save"]);
			}
		}

        public function deleteConf(){
            if(isset($_POST["id"])){
                $this->event_dao->deleteById($_POST["id"]);
                redirect($_POST["redirect"]);
            }
        }

        public function rewardTopClanBoss(){
			
            $request = getDataRequest('RequestRewardTopClanBoss', $_POST);
			if($request->top < 1 || $request->top > 3){
                header("HTTP/1.0 404 so luong top nhan thuong chi tu 1 -> 3");die;
            }
			$this->load->model('log_event_clan_boss_dao');
            $this->load->model('clandao');
            $this->load->model('playerdao');
            $this->load->model('messagedao');
            $this->load->model('event_dao');
            $eventList = $this->event_dao->findListEventEndedToReward('CLAN_BOSS');

            if(count($eventList) > 0){

                foreach($eventList as $event){

                    if($event->server == 'all'){

                        $serverList = $this->request(array("doc_type" => "SERVER"), $this->api["gmtool_get_base"]);

                        foreach($serverList->cache_data as $server){
                            $this->sendMessageTopClanBoss($server->code, $request);
                        }
                    }
                    else
                    {
                        $this->sendMessageTopClanBoss($event->server, $request);
                    }

                    $event->isRewarded = true;
                    $this->event_dao->save($event);
                }
            }
            else
            {
                header("HTTP/1.0 404 Su kien chua ket thuc, hoac su kien da duoc trao thuong roi!");die;
            }
        }

        private function createMessageRewardClanBoss($top, $player, $rewardId){
            $message = array(
                "messageType" => "REWARD",
                "title" => "Phần thưởng top".$top." sự kiện top kích sát Boss Bang hội",
                "content" => "",
                "owner" => $player->code,
                "codeReward" => $rewardId,
                "server" => $player->server,
                "status" => "PRIVATE",
            );
            return $message;
        }

        private function sendMessageTopClanBoss($server, $request){

            $tops = $this->log_event_clan_boss_dao->getTopClanBoss($server, intval($request->top));
            if(isset($tops["result"])){

                for($i = 0; $i < count($tops["result"]); $i++){
                    $clan = $this->clandao->findById($tops["result"][$i]["_id"]);
					if(isset($clan->_id)){
						$playerList = $this->playerdao->findByClanId($clan->_id->{'$id'});
						foreach($playerList as $player){
							if($player->code == $clan->owner){
								$this->messagedao->saveMessage($this->createMessageRewardClanBoss($i+1, $player, $request->{'rewardMasterTop'.($i+1)}));
							}
							else
							{
								$this->messagedao->saveMessage($this->createMessageRewardClanBoss($i+1, $player, $request->{'rewardMemTop'.($i+1)}));
							}
						}
					}
                }

            }
        }
		
		public function treeItem(){
			$listEvent = $this->event_dao->findListNewestCollection();
            $now = DateUtil::getCurrentUnix();
            $material = $this->request(array("doc_type" => "MATERIAL"), $this->api["gmtool_get_base"]);
            $usableItem = $this->request(array("doc_type" => "USABLE_ITEM"), $this->api["gmtool_get_base"]);
			
			$response = file_get_contents(DIR_STRUCT_DATA."tree_item.json");
			$config = json_decode($response);
			
			$items = array_merge($material, $usableItem);
            $this->datas["sub"] = "event/tree_item";
            $this->datas["data"] = array(
                "title"     => "Mật Đồ Thần Bí",
				"items"		=> $items,
				"config"	=> $config
            );
            $this->load->view(TEMPLATE, $this->datas);
		}
		
		public function saveEventTreeItem(){
			$response = file_get_contents(DIR_STRUCT_DATA."tree_item.json");
			$data = json_decode($response);
			$validate = array("MATERIAL","USABLE_ITEM");
			foreach($data as $e){
				if(in_array($e->item->docType, $validate)){
					$req = array(
						"id" => $e->id,
						"parent" => $e->parent,
						"node" => $e->node,
						"point" => $e->point,
						"quantity" => $e->item->quantity,
						"item_id" => $e->item->parent,
						"doc"	=> $e->item->docType
					);		
					// echo json_encode($req);die;
					$this->request($req, API_URL."public/gmtool/treeitem/save");
				}
			}
		}
    }