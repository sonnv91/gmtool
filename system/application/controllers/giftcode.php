<?php

class giftcode extends BaseController{

    function __construct(){
        parent::__construct();
        $this->load->model("giftcode_dao");
    }

    public function generateGiftcode(){

        $rewardId = "5865c6daef208134738a1732";

        $_POST["amount"] = 1000;
        $_POST["timeEnd"] = false;

        $amount = intval($_POST["amount"]);
        $timeEnd = $_POST["timeEnd"] ? new MongoDate(strtotime("2016-06-01")) : new MongoDate(strtotime("2030-01-01"));
        for($i = 0; $i < $amount; $i++){
            $rand = StringUtil::randomString('041');
            echo $rand."<br/>";
            $this->giftcode_dao->createGiftcode($rand, $rewardId, $timeEnd);
        }
    }

    public function super(){
        $amount = 1000;
        $rewardId = array(
            "568a4dd84e69457f16488d6d",
            "568b2f7b4e69457f1648a4c1",
            "568b2f814e69457f1648a4c3",
            "568b2f854e69457f1648a4c5",
            "568b2f884e69457f1648a4c7",
            "568b2f8c4e69457f1648a4ca",
            "568b2f904e69457f1648a4cc",
            "568b2f954e69457f1648a4ce",
            "568b2f984e69457f1648a4d0",
            "568b2f9d4e69457f1648a4d2",
            "568b2fa04e69457f1648a4d3",
            "568b2faf4e69457f1648a4d8"
        );
        $codeType = array(
            "001",
            "002",
            "003",
            "004",
            "005",
            "006",
            "007",
            "008",
            "009",
            "010",
            "011",
            "012",
        );
        for($i = 1; $i <= 12; $i++ ){
            $timeEnd = $codeType[$i - 1] == "008" ? new MongoDate(strtotime("2016-03-31")) : new MongoDate(strtotime("2030-01-01"));
            for($j = 0; $j < $amount; $j++){
                $rand = StringUtil::randomString($codeType[$i - 1]);
                echo $rand."<br/>";
                //$this->giftcode_dao->createGiftcode($rand, $rewardId[$i - 1], $timeEnd);
            }
        }
    }

    public function listGiftcode(){
        $x = $this->uri->segment(3);
        //echo $x;
        $a = $this->giftcode_dao->findGiftcodeByPre($x);
        foreach($a as $b){
            echo $b->giftCode."<br/>";
        }
    }
}