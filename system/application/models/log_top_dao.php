<?php

class log_top_dao extends BaseDao{


    function __construct(){
        parent::__construct();
        $this->collection = "log_top";
    }
	
	public function insertLog($tops){
		$logEntity = array(
			"id" => new MongoId(),
			"className" => "bussiness.entity.top.LogTopEntity",
			"server" => "all",
			"type" => "RANK_CHAOS",
			"tops" => $tops,
			"createTime" => new MongoDate(),
			"docType" => "LOG_TOP"
		);
		return $this->insert($this->collection, $logEntity);
	}
}