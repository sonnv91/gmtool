<?php

class log_bidding_castle_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_bidding_castle";
    }

    public function findTop1($cluster, $castleId){
		$where = array(
			"cluster" => $cluster,
			"castleId" => $castleId
		);
		
        $entity = $this
            ->order_by(array("point"=> -1, "updateTime" => 1))
            ->get_where($this->collection, $where)
            ->row();
			
		return $entity;
	}
	
	public function dropCollection(){
		return $this->drop_collection($this->db, $this->collection);
	}
}