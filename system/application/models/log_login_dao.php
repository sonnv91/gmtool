<?php

class log_login_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_login";
    }

    public function dau(){
		$time = time() - 30*24*60*60;
		$from = new MongoDate($time);
        $aggregate = array(
			array(
				'$match' => array('createTime' => array('$gte' => $from))
			),
            array(
                '$group' => array(
                    '_id' => array(
                        'year'  => array('$year' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'month' => array('$month' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'day'   => array('$dayOfMonth' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'username'  => '$username'
                    )
                )
            ),
            array(
                '$group' => array(
                    '_id' => array(
                        'year' => '$_id.year',
                        'month' => '$_id.month',
                        'day' => '$_id.day',
                    ),
                    'count' => array('$sum' => 1)
                )
            ),
            array(
                '$sort' => array('_id' => 1)
            )
        );
        return $this->aggre($aggregate, true);
    }

    public function dauByDate($from, $to){
        $where = array(
            '$and' => array(
                array('createTime' => array('$gte' => $from)),
                array('createTime' => array('$lte' => $to))
            )
        );
        $entity = $this
            ->get_where($this->collection, $where)
            ->count();
        return $entity;
    }

    public function dauOldUser($from, $to, $excludeUser =  array()){
        $aggregate = array(
            array(
                '$match' => array(
                    '$and' => array(
                        array('createTime' => array('$gte' => $from)),
                        array('createTime' => array('$lte' => $to))
                    ),
                    'username' => array(
                        '$in' => $excludeUser
                    )
                )
            ),
            array(
                '$group' => array(
                    '_id' => array(
                        'year'  => array('$year' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'month' => array('$month' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'day'   => array('$dayOfMonth' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'username'  => '$username'
                    )
                )
            ),
            array(
                '$group' => array(
                    '_id' => array(
                        'year' => '$_id.year',
                        'month' => '$_id.month',
                        'day' => '$_id.day',
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
	
	public function dauByDay($from, $to){
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
                    '_id' => array(
                        'year'  => array('$year' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'month' => array('$month' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'day'   => array('$dayOfMonth' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'username'  => '$username'
                    )
                )
            ),
            array(
                '$group' => array(
                    '_id' => array(
                        'year' => '$_id.year',
                        'month' => '$_id.month',
                        'day' => '$_id.day',
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
}