<?php

class player_chaos_dao extends BaseDao{


    function __construct(){
        parent::__construct();
        $this->collection = "player_chaos";
    }
	
	public function findTopChaos(){
		$where = array(
			'point' => array('$gte' => 100)
		);
		
		$entity = $this
            ->order_by(array("point" => -1, "lastTimeWin" => 1))
            ->get_where($this->collection, $where)
            ->result_object();
        return $entity;
	}
	
	public function resetPoint($point){
		$where = array();
		$updateData = array('point' => $point);
        return $this->update_batch($this->collection, $updateData);
	}
}