<?php
class MessageDao extends BaseDao{

    /**
     * Thoi gian message ton tai
     */
    private $timeMessageRemain = 604800; // 7 ngay

    function __construct(){
        parent::__construct();
        $this->collection = "messages";
    }

    public function saveMessage($req){
        $now = time();
        $createTime = isset($req["createTime"]) ? $req["createTime"] : new MongoDate($now);
        $endTime = isset($req["endTime"]) ? $req["endTime"] : new MongoDate($now + $this->timeMessageRemain);
        $messageEntity = array(
            "className" => "bussiness.entity.MessageEntity",
            "messageType" => $req["messageType"],
            "title" => $req["title"],
            "content" => $req["content"],
            "createTime" => $createTime,
            "endTime" => $endTime,
            "server" => $req["server"],
            "isRewarded" => false,
            "docType" => "MESSAGE"
        );
        $messageEntity["status"] = (isset($req["status"])) ? $req["status"] : "PRIVATE";
        if(isset($req["owner"])) $messageEntity["owner"] = $req["owner"];
        if(isset($req["codeReward"]) && $req["codeReward"] != null){
            $messageEntity["codeReward"] = $req["codeReward"];
        }else{
            $messageEntity["isRewarded"] = true;
        };
        if(isset($req["link"])) $messageEntity["link"] = $req["link"];
        return $this->insert($this->collection, $messageEntity);
    }
}