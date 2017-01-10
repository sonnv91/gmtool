<?php

class log_bonus_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_bonus";
    }
	
	public function getData($owner){
		$where = array('owner'=>$owner);
        $logs = $this
            ->order_by(array("createTime"=> -1))
            ->get_where($this->collection, $where)
            ->result_object();
        return $logs;
	}
}