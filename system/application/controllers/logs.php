<?php

class logs extends BaseController{

    function __construct()
    {
        parent::__construct();
        $this->datas["active_menu"] = __CLASS__;
    }

    public function logTrans(){

        $this->load->model("log_transaction_dao");
        $request = getDataRequest("RequestLogTransaction", $_POST);
        $serverList = $this->request(array("doc_type" => "SERVER"), $this->api["gmtool_get_base"]);

        $uid = isset($request->uid) ? $request->uid : "";
        $server = isset($request->server) ? $request->server : "";
        $owner = $uid."_".$server;
        $logs = ValidateUtil::isEmpty($uid) ? array() : $this->log_transaction_dao->findLogsByOwner($owner);

        $this->datas["sub"] = "logs/trans";
        $this->datas["data"] = array(
            "title" => "Log nạp KNB",
            "serverList" => $serverList->cache_data,
            "logs"   => $logs,
            "uid" => $uid,
            "server" => $server
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function logInventory(){
        $this->load->model("log_inventory_dao");
        $this->load->library('pagination');

        $key = $this->uri->segment(3) ? $this->uri->segment(3) : -1;
        $offset = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        //if (isset($_POST["search_key"])) $key = $_POST["search_key"];
        $logs = $key == -1 ? array() : $this->log_inventory_dao->findLogsByOwner($key, $offset, RECORD_PER_PAGE);

        $config['base_url'] = site_url('logs/inventory/' . $key);
        $config['total_rows'] = $key == -1 ? 0 : $this->log_inventory_dao->countLogsByOwner($key);
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $this->datas["title"] = "Log rương đồ";
        $this->datas["sub"] = "logs/inventory";
        $this->datas["data"] = array(
            "logs" => $logs,
            "pagination" => $this->pagination->create_links()
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function logCoin(){

        $this->load->model("log_coin_dao");
        $this->load->library('pagination');

        $key = $this->uri->segment(3) ? urldecode($this->uri->segment(3)) : -1;
        $offset = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        //if (isset($_POST["search_key"])) $key = $_POST["search_key"];
        $logs = $key == -1 ? array() : $this->log_coin_dao->findLogsByOwner($key, $offset, RECORD_PER_PAGE);

        $config['base_url'] = site_url('logs/coin/' . $key);
        $config['total_rows'] = $key == -1 ? 0 : $this->log_coin_dao->countLogsByOwner($key);
        $config["uri_segment"] = 4;

        $this->pagination->initialize($config);

        $this->datas["title"] = "Log sử dụng KNB";
        $this->datas["sub"] = "logs/coin";
        $this->datas["data"] = array(
            "logs" => $logs,
            "pagination" => $this->pagination->create_links()
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

}