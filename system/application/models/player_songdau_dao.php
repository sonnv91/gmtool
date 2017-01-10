<?php

class player_songdau_dao extends BaseDao{


    function __construct(){
        parent::__construct();
        $this->collection = "player_songdau";
    }
	
	public function findTop($size){
		$where = array();
        $entity = $this
			->select(array("owner","pointWin"))
            ->order_by(array("pointWin" => -1, "lastUpdate"=> 1))
            ->get_where($this->collection, $where, $size, 0)
            ->result_object();
        return $entity;
	}
	
	public function resetPointWin(){
        $where = array();
		$updateData = array(
			"pointWin" => 0
		);
		$options = array(
			"multiple" => true
		);
        return $this->where($where)->update($this->collection, $updateData, $options);
    }
}