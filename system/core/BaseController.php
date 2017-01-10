<?php
	class BaseController extends CI_Controller{

		protected $datas;
        protected $api;

		function __construct(){
			parent::__construct();
            checkLogin();
            $this->loadApi();
            $this->lang->load('autovl', 'vi');
            $this->datas["menu"] = getMenuConfig();
		}

        protected function isAllowAccess(){
            if(!checkPerm()){
                redirect(base_url()."access/permission");
            }
        }

        protected function getAdminInfo(){
            $file_user = DIR_CONFIG_PERMISSION_FILE."user.json";
            $fh = fopen($file_user,"rb");
            $content = stream_get_contents($fh);
            fclose($fh);
            $listUser = json_decode($content);
            foreach($listUser as $user){
                if($user->username == $this->session->userdata("username")) return $user;
            }
            return null;
        }

        protected function createBaseRequest($token = ""){
            $request = array(
                "data" => "",
                "sandbox" => false,
                "token" => $token
            );

            return $request;
        }

        protected function request($data, $url_api){
            $request = $this->createBaseRequest();
            $request["data"] = base64_encode(json_encode($data));
            $response = json_decode(httpPost($url_api, $request));
            if($response == false){
                show_error('Cannot connect to server! Please try again later');
            }
            if(!$response->status){
                $data = json_decode(base64_decode($response->data));

                show_error($data->error->message, 500, $data->error->code);
            }
            return json_decode(base64_decode($response->data));
        }

        protected function get($url_api){
            $response = json_decode(httpGet($url_api));
            if($response == false){
                show_error('Cannot connect to server! Please try again later');
            }
            if(!$response->status){
                $data = json_decode(base64_decode($response->data));

                show_error($data->error->message, 500, $data->error->code);
            }
            return json_decode(base64_decode($response->data));
        }

        protected function getSimpleDataItem(){
            $items = array();
            $list = array();
            foreach($this->config->item("ITEM_TYPE") as $type){
                $entity = $this->request(array("doc_type" => $type), $this->api["gmtool_get_base"]);
                $list = array_merge($list, $entity->cache_data);
            }
            foreach($list as $l){
                $items[$l->id]["doc_type"] = $l->docType;
                $items[$l->id]["name"] = $l->name;
            }
            return $items;
        }

        protected function createDataResponse($error_code){
            $response = new stdClass();
            $error = $this->config->item("ERROR_CODE");
            $response->error_code = $error_code;
            $response->message = $error[$error_code];
            return json_encode($response);
        }

        private function loadApi(){
			$this->config->load("remote");
			$remote_api = $this->config->item('remote_api');
            $this->api = $this->config->item($remote_api[$this->session->userdata("server_remote")]);
        }
	}