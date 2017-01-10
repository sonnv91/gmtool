<?php

class log_map_complete_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_map_complete";
    }
	
	public function findByMapId($mapId){
		$where = array('owner' => '91200007220_S6','mapId' => $mapId);
        $entity = $this
            ->get_where($this->collection, $where)
            ->row();
        return $entity;
	}
}