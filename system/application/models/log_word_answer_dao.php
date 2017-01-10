<?php
class log_word_answer_dao extends BaseDao{
	
    function __construct(){
        parent::__construct();
        $this->collection = "log_word_question";
    }

    public function findTop($server){
		$where = array(
			'server' => $server,
		);
		$entity = $this
			->order_by(array("point" => -1,"createTime"=> 1))
            ->get_where($this->collection, $where,10,0)
            ->result_object();
        return $entity;
    }
}