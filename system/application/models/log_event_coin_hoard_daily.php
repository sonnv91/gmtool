<?php

class log_event_coin_hoard_daily extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_event_coin_hoard_daily";
    }

    public function findLog(){
		$from = new MongoDate(strtotime('2016-04-11 00:00:00'));
        $where = array(
            'createTime' => array('$gte', $from)
        );
        $entity = $this
			->order_by(array("createTime" => -1))
            ->get_where($this->collection, $where)
            ->result_object();
        return $entity;
    }

}