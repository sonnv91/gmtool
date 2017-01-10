<?php

class log_transaction_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_transaction";
    }

    public function pu(){
		$time = time() - 30*24*60*60;
		$from = new MongoDate($time);
        $aggregate = array(
            array(
                '$match' => array(
                    'amount' => array(
                        '$gt' => 0
                    ),
					'createTime' => array('$gte' => $from)
                )
            ),
			array(
                '$group' => array(
                    '_id' => array(
                        'year'  => array('$year' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'month' => array('$month' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'day'   => array('$dayOfMonth' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'owner' => '$owner'
                    )
                )
            ),
            array(
                '$group' => array(
                    '_id' => array(
                        'year'  => '$_id.year',
                        'month' => '$_id.month',
                        'day'   => '$_id.day'
                        //'owner' => '$owner'
                    ),
                    'count' => array('$sum' => 1)
                )
            ),
            array(
                '$sort' => array('_id' => 1)
            )
        );
        return $this->aggre($aggregate);
    }

    public function rev($gateway){
		$time = time() - 30*24*60*60;
		$from = new MongoDate($time);
        $aggregate = array(
            array(
                '$match' => array(
                    'coin' => array(
                        '$gt' => 0
                    ),
					'gateway' => $gateway,
					'createTime' => array('$gte' => $from)
                )
            ),
            array(
                '$group' => array(
                    '_id' => array(
                        'year'  => array('$year' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'month' => array('$month' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'day'   => array('$dayOfMonth' => array('$add' => array('$createTime',MILISECOND_GMT7)))
                    ),
                    'count' => array('$sum' => '$amount')
                )
            ),
            array(
                '$sort' => array('_id' => 1)
            )
        );
        return $this->aggre($aggregate);
    }

    public function findLogsByOwner($owner){
        $where = array("owner" => $owner);
        $list = $this
            ->order_by(array("createTime"=> -1))
            ->get_where($this->collection, $where)
            ->result_object();
        return $list;
    }
	
	public function coinChargeOfDay($from, $to){
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
					'sumCoin' => array('$sum' => '$coin')
				)
			),
			array(
				'$match' => array(
					'sumCoin' => array('$gte' => 500)
				)
			)
		);
		return $this->aggre($aggregate);
	}
	
	public function bugOrderId(){
		$aggregate = array(
			array(
				'$match' => array(
					'status' => 'COMPLETED',
					'coin' => array('$gt' => 0)
				)
			),
			array(
				'$group' => array(
					'_id' => '$orderId',
					'count' => array('$sum' => 1)
				)
			),
			array(
				'$match' => array('count' => array('$gte' => 2))
			)
		);
		return $this->aggre($aggregate);
	}
	
	public function findByOrderId($orderId){
		$where = array('orderId' => $orderId);
		$list = $this
            ->get_where($this->collection, $where)
            ->row();
        return $list;
	}
	
	public function listTranInRange($from, $to){
		$where = array(
			'$and' => array(
				array('createTime' => array('$gte' => $from)),
				array('createTime' => array('$lte' => $to))
			),
			// 'currency' => 'VND',
			'gateway' => 'GOSU',
			'coin' => array('$gt' => 0),
			'status' => 'COMPLETED'
		);
        $logs = $this
			->order_by(array("createTime" => -1))
            ->get_where($this->collection, $where)
            ->result_object();
        return $logs;
	}
	public function listTranUSDInRange($from, $to){
		$where = array(
			'$and' => array(
				array('createTime' => array('$gte' => $from)),
				array('createTime' => array('$lte' => $to))
			),
			'currency' => 'USD',
			// 'gateway' => 'GOSU',
			'coin' => array('$gt' => 0),
			'status' => 'COMPLETED'
		);
        $logs = $this
			->order_by(array("createTime" => -1))
            ->get_where($this->collection, $where)
            ->result_object();
        return $logs;
	}
	public function fixCoinhoard($from){
		$aggregate = array(
			array(
				'$match' => array(
					'createTime' => array('$gte' => $from)
				)
			),
			array(
				'$group' => array(
					'_id' => '$owner',
					'coinHoard' => array('$sum' => '$coinHoard')
				)
			),
			array(
				'$match' => array(
					'coinHoard' => array('$gt' => 0)
				)
			)
		);
		return $this->aggre($aggregate);
	}
	public function fixCoinhoard2($from, $to){
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
					'coinHoard' => array('$sum' => '$coinHoard')
				)
			),
			array(
				'$match' => array(
					'coinHoard' => array('$gte' => 2000)
				)
			)
		);
		return $this->aggre($aggregate);
	}
}