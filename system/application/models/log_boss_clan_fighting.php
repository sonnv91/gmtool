<?php

class log_boss_clan_fighting extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_boss_clan_fighting";
    }

    public function fancyDamage(){
        $aggregate = array(
			array(
				'$match' => array(
					'damage' => array('$gt' => 5000000)
				)
			),
			array(
				'$group' => array(
					'_id' => '$owner',
					'damage' => array('$max' => '$damage'),
				)
			),
			array(
				'$sort' => array(
					'damage' => -1
				)
			)
        );

        return $this->aggre($aggregate);
    }
}