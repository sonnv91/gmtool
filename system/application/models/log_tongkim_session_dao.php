<?php

class log_tongkim_session_dao  extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "log_tongkim_session";
    }

}