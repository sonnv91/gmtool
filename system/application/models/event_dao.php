<?php

class event_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "event";
    }

    public function findEventActiveByType($eventType, $server){
        $now  = new MongoDate();
        $where = array(
            'eventType' => $eventType,
            'endTime' => array(
                '$gt' => $now
            )
        );
        if($server !== 'all'){
            $where['$or'] = array(
                array('server' => $server),
                array('server' => 'all')
            );
        }
        $where['eventType'] = $eventType;
        $where['endTime'] = array('$gt' => $now);
        $where['createTime'] = array('$lt' => $now);
        $entity = $this
            ->get_where($this->collection, $where)
            ->row();
        return $entity;
    }

    public function findListEventEndedToReward($eventType){
        $now = new MongoDate();
        $where = array(
            'eventType'     => $eventType,
            'endTime'       => array('$lt' => $now),
            'isRewarded'    => false
        );
        $entity = $this
            ->get_where($this->collection, $where)
            ->result_object();
        return $entity;
    }

    public function findEventByType($server, $type){
        $where['$or'] = array(
            array('server' => $server),
            array('server' => 'all')
        );
        $where['eventType'] = $type;
        $entity = $this
            ->get_where($this->collection, $where)
            ->row();
        return $entity;
    }
}