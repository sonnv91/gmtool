<?php

class LogBossSessionDao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_boss_session";
    }

}