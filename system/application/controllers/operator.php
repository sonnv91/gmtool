<?php
    class Operator extends BaseController{

        function __construct(){
            parent::__construct();
            $this->datas["active_menu"] = __CLASS__;
        }

        public function listPermission(){
            $this->datas["sub"] = "operator/permission";
            $this->datas["data"] = array();
        }
    }