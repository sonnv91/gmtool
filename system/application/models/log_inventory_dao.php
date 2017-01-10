<?php

class log_inventory_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_inventory";
    }

    public function findLogsByOwner($owner, $offset, $limit){
        $where = array("owner" => $owner);
        $list = $this
            ->order_by(array("createTime" => -1))
            ->get_where($this->collection, $where, $limit, $offset)
            ->result_object();
        return $list;
    }

    public function countLogsByOwner($owner){
        $where = array("owner" => $owner);
        return $this->get_where($this->collection, $where)->count();
    }
}