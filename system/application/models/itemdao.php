<?php

class itemdao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "items";
    }

    public function findItemByParent($parent){
        $where = array(
            'parent'     => $parent
        );
        $entity = $this
			->order_by(array("quantity" => -1))
            ->get_where($this->collection, $where, 100, 0)
            ->result_object();
        return $entity;
    }
	
	public function findByOwnerAndParent($owner, $parent){
		$where = array(
			'owner'		=> $owner,	
            'parent'	=> $parent
        );
        $entity = $this
            ->get_where($this->collection, $where)
            ->row();
        return $entity;
	}
	
	public function shitItem($key,$parent){
		// $from = DateUtil::toMongoDate("06-05-2016 09:30:00");
		$to = DateUtil::toMongoDate("06-05-2016 12:00:00");
		$where = array(
			'owner' => new MongoRegex('/'.$key.'$/'),
			// 'owner' => '91604942676_S6',
			'parent' => $parent,
			// 'level' => 80,
			// 'createTime' => array('$lte' => $to),
			'quality' => 'PURPLE',
			'equipmentType' => 'NORMAL'
		);
		$entity = $this
            ->get_where($this->collection, $where)
            ->result_object();
        return $entity;
	}
}