<?php

class log_ccu_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_ccu";
    }

    public function ccu($from, $to){
        $aggregate = array(
            array(
                '$match' => array(
                    'server' => 'PUBLIC',
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
                        'hour'   => array('$hour' => array('$add' => array('$createTime',MILISECOND_GMT7))),
                        'minute'   => array('$minute' => array('$add' => array('$createTime',MILISECOND_GMT7)))
                    ),
                    'count' => array('$max' => '$ccu')
                )
            ),
            array(
                '$sort' => array('_id' => 1)
            )
        );
        return $this->aggre($aggregate);
    }

}