<?php

class log_coin_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_coin";
    }

    public function findLogsByOwner($owner, $offset, $limit){
        $where = array("owner" => $owner);
        $list = $this
            ->order_by(array("createTime" => -1))
            ->get_where($this->collection, $where, $limit, $offset)
            ->result_object();
        return $list;
    }

    public function countLogsByOwner($owner){
        $where = array("owner" => $owner);
        return $this->get_where($this->collection, $where)->count();
    }
	
	public function logCoinGroupon($mongoDate){
        $aggregate = array(
			array(
				'$match' => array(
					'action' => "services.GrouponService",
					'createTime' => array('$gt' => $mongoDate)
				)
			),
            array(
                '$group' => array(
                    '_id' => '$owner',
                    'totalCoin' => array('$sum'=>'$change')
                )
            ),
            array(
                '$sort' => array('totalCoin' => 1)
            )
        );
        return $this->aggre($aggregate);
	}
}