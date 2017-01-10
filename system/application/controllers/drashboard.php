<?php

class DrashBoard extends BaseController{

    function __construct(){
        parent::__construct();
        $this->datas["active_menu"] = __CLASS__;
    }

    function index(){
        $this->datas["sub"] = "main";
        $this->datas["data"] = array();
        $this->load->view(TEMPLATE, $this->datas);
    }
}