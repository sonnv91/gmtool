<?php

class characterdao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "characters";
    }
	
	public function findMain($owner){
		$where = array(
            'owner'     => $owner,
			'isMain'	=> true
        );
        $entity = $this
            ->get_where($this->collection, $where)
            ->row();
        return $entity;
	}
}