<?php

class clan extends BaseController{

    function __construct(){
        parent::__construct();
    }

    public function getInfoClan(){
        if(isset($_POST["clanId"])){
            $this->load->model("playerdao");
            $listPlayer = $this->playerdao->findByClanId($_POST["clanId"]);
            echo base64_encode(json_encode($listPlayer));
        }
    }

}