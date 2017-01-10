<?php

class log_castle_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_castle";
    }

    public function findByClusterAndCastleId($cluster, $castleId){
		$where = array(
			"cluster" => $cluster,
			"castleId" => $castleId
		);
		
        $entity = $this
            ->get_where($this->collection, $where)
            ->row();
			
		return $entity;
	}
	
	public function insertLog($entity){
		return $this->insert($this->collection, $entity);
	}
}