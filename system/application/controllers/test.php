<?php
class test extends BaseController{

        function __construct(){
            parent::__construct();
        }

        public function index(){
			echo phpinfo();die;
            $this->load->view("welcome_message");
        }

        public function vkl(){
            $this->load->model("log_boss_clan_fighting");
            $this->load->model("playerdao");
            $this->load->model("user_dao");

            $data = $this->log_boss_clan_fighting->fancyDamage();
			//var_dump($data);
			header('Content-Type: text/html; charset=utf-8');
			foreach($data["result"] as $dt){
				$str = "";
				$userData = explode("_",$dt["_id"]);
				//die($userData[0]);
				$user = $this->user_dao->findByUsername($userData[0]);
				$player = $this->playerdao->findByPlayerCode($dt["_id"]);
				
				$str .= $dt["_id"]."\t".$player->name."\t".$dt["damage"]."\t";
				if(isset($user->status) && $user->status == "INACTIVE") $str .= "LOCKED";
				
				echo $str."<br/>";
			}
            //echo json_encode($data);
        }
		
		public function data(){
			header('Content-Type: text/html; charset=utf-8');
			$base = $this->request(array("doc_type" => "WEAPON"), $this->api["gmtool_get_base"]);
			$arr = array();
            foreach($base->cache_data as $b){
				if(!isset($b->equipmentType)) echo "vkl: ".$b->name;
				if(in_array($b->name,$arr) && $b->equipmentType == "NORMAL") echo $b->name."<br/>";
				if($b->equipmentType == "NORMAL") $arr[] = $b->name;
			}
			//echo json_encode($arr);
		}
		
		public function naptien(){
			$this->load->model("log_transaction_dao");
			$from = new MongoDate(strtotime("2016-04-12 00:00:00"));
			$to = new MongoDate(strtotime("2016-04-12 23:59:59"));
			$response = $this->log_transaction_dao->coinChargeOfDay($from, $to);
			foreach($response['result'] as $res){
				echo $res["_id"]."<br/>";
			}
			// echo json_encode($response);
		}
		
		public function topItem(){
			header('Content-Type: text/html; charset=utf-8');
			$this->load->model("itemdao");
			$this->load->model("playerdao");
			$items = $this->itemdao->findItemByParent("559125b1dbb4747c5ef2d6c0");
			foreach($items as $item){
				$player = $this->playerdao->findByPlayerCode($item->owner);
				echo $player->name."(VIP $player->vip) : ".$item->quantity."<br/>";
			}
		}
		
		public function logeventcoinhoard(){
			header('Content-Type: text/html; charset=utf-8');
			$this->load->model("log_event_coin_hoard_daily");
			//echo strtotime('2016-04-11 00:00:00');die;
			$logs = $this->log_event_coin_hoard_daily->findLog();
			var_dump($logs);
			foreach($logs as $log){
				echo $log->owner."<br/>";
			}
		}
    }