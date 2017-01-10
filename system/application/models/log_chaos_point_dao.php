<?php

class log_chaos_point_dao extends BaseDao{


    function __construct(){
        parent::__construct();
        $this->collection = "log_chaos_point";
    }
	
	public function logPoint($from, $to){
		$aggregate = array(
            array(
                '$match' => array(
                    '$and' => array(
                        array('createTime' => array('$gte' => $from)),
                        array('createTime' => array('$lte' => $to))
                    )
                )
            ),
            array(
                '$group' => array(
                    '_id' => '$owner',
                    'point' => array('$sum' => '$change')
                )
            ),
            array(
                '$match' => array('point' => array('$gte' => 100))
            )
        );
		return $this->aggre($aggregate);
	}
}