<?php

class checkin extends BaseController{

    function __construct(){
        parent::__construct();
        $this->datas["active_menu"] = 'StaticData';
        $this->load->model("checkindao", "checkin");
    }

    public function index(){

        $rewards = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);

        $configs = $this->checkin->findListNewestCollection();

        $this->datas["sub"] = "static_data/checkin";
        $this->datas["data"] = array(
            "title" => "Điểm danh hàng ngày",
            "configs"  => $configs,
            "rewards" => $rewards->cache_data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function saveCheckinConfig(){
        $request = getDataRequest('RequestCheckinConfig', $_POST);
        if(ValidateUtil::isEmpty($request->id)){
            $dateTime = new DateTime();
            $year = intval($request->year);
            $month = intval($request->month);

            $dateTime->setDate($year, $month, 1);
            $dateTime->setTime(0,0,0);
            $createTime = new MongoDate($dateTime->getTimestamp());

            $dateTime->setDate($year, $month, cal_days_in_month(CAL_GREGORIAN, $month, $year));
            $dateTime->setTime(23,59,59);
            $endTime = new MongoDate($dateTime->getTimestamp());

            $listRewardId = array_filter($request->list_reward_id, function($val){return !ValidateUtil::isEmpty($val);});

            $insertData = array(
                "createTime" => $createTime,
                "endTime" => $endTime,
                "listRewardId" => $listRewardId
            );
            $config = $this->checkin->createNewConfig($insertData);
            echo json_encode($config);
        }
        else
        {
            $config = $this->checkin->findById($request->id);
            $config->listRewardId = $request->list_reward_id;
            $this->checkin->save($config);
            echo json_encode($config);
        }
    }

    public function deleteCheckinConfig(){
        $this->checkin->deleteById($_POST["id"]);
        redirect($_POST["redirect"]);
    }

}