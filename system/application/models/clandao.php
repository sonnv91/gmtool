<?php

class clandao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "clans";
    }
}