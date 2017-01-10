<?php

class giftcode_dao extends BaseDao{

    function __construct(){
        parent::__construct();
        $this->collection = "giftcode";
    }

    public function createGiftcode($giftcode, $rewardId, $timeEnd){
        $col = $this->createGiftcodeCollection($giftcode, $rewardId, $timeEnd);
        $this->insert($this->collection, $col);
    }

    public function findGiftcodeByPre($regex){
        $where = array(
            'giftCode' => new MongoRegex("/^$regex/i")
        );
        $giftcodes = $this
            ->get_where($this->collection, $where)
            ->result_object();
        return $giftcodes;
    }

    private function createGiftcodeCollection($giftcode, $rewardId, $timeEnd){

        return array(
            "className" => "bussiness.entity.GiftEntity",
            "giftCode" => $giftcode,
            "rewardId" => $rewardId,
            "used" => false,
            "timeEnd" => $timeEnd,
            "docType" => "GIFT_CODE"
        );
    }
}