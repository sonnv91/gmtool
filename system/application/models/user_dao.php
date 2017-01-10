<?php

class user_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "users";
    }

    public function nru(){
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
                        'day'   => array('$dayOfMonth' => array('$add' => array('$createTime',MILISECOND_GMT7)))
                    ),
                    'count' => array('$sum'=>1)
                )
            ),
            array(
                '$sort' => array('_id' => 1)
            )
        );
        return $this->aggre($aggregate);
    }

    public function nruByDate($from, $to){
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

    public function nruByDate2($from, $to){
        $where = array(
            '$and' => array(
                array('createTime' => array('$gte' => $from)),
                array('createTime' => array('$lte' => $to))
            )
        );
        $entity = $this
            ->select(array("username"))
            ->get_where($this->collection, $where)
            ->result_object();
        return $entity;
    }
	
	public function findByUsername($username){
		$where = array(
            'username' => $username
        );
		$entity = $this
            ->get_where($this->collection, $where)
            ->row();
        return $entity;
	}
	
	public function updateStatus($username, $status){
		$where = array(
            "username" => $username
        );
		$updateData = array('userStatus' => $status);
        return $this->where($where)->update($this->collection, $updateData);
	}
}