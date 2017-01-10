<?php

class log_event_clan_boss_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_event_clan_boss";
    }

    public function getTopClanBoss($server, $limit){
        $aggregate = array(
            array(
                '$match' => array(
                    'server' => $server
                )
            ),
            array(
                '$group' => array(
                    '_id' => '$clanId',
                    'damage' => array('$sum' => '$damage')
                )
            ),
            array(
                '$sort' => array('damage' => -1)
            ),
            array(
                '$limit' => $limit
            )
        );
        return $this->aggre($aggregate);
    }

}