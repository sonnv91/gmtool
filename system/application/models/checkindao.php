<?php

class CheckinDao extends BaseDao {

    function __construct(){
        parent::__construct();
        $this->collection = "checkin_config";
    }

    public function findLastCheckinConfig(){
        $where = array();
        $checkinConfig = $this
            ->order_by(array("createTime"=> -1))
            ->get_where($this->collection, $where, 1, 0)
            ->result_object();
        return $checkinConfig;
    }

    public function createNewConfig($data){
        $config = array(
            "_id" => new MongoId(),
            "className" => "bussiness.entity.checkin.CheckinConfig",
            "docType" => "CHECKIN_CONFIG",
            "createTime" => $data["createTime"],
            "endTime" => $data["endTime"],
            "listRewardId" => $data["listRewardId"]
        );
        $this->insert($this->collection, $config);
        return (object)$config;
    }
}