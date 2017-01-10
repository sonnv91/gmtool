<?php

class log_niu_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_niu";
    }

    public function niu($key){
		$time = time() - 30*24*60*60;
		$from = new MongoDate($time);
        $aggregate = array(
			array(
				'$match' => array('createTime' => array('$gte' => $from))
			),
            array(
                '$match' => array(
                    'os' => new MongoRegex("/$key/i")
                )
            ),
            array(
                '$group' => array(
                    '_id' => array(
                        'year'  => array('$year' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'month' => array('$month' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'day'   => array('$dayOfMonth' => array('$add' => array('$createTime',MILISECOND_GMT7)))
                    ),
                    'count' => array('$sum' => 1)
                )
            ),
            array(
                '$sort' => array('_id' => 1)
            )
        );
        if($key == "all") array_shift($aggregate);
        return $this->aggre($aggregate);
    }
}