<?php

class log_event_midautumn_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_event_midautumn";
    }

    public function findTop(){
        $where = array();
        $entity = $this
			->order_by(array("point" => -1, "createTime" => 1))
            ->get_where($this->collection, $where, 10, 0)
            ->result_object();
        return $entity;
    }

}