<?php
require_once "base/GameObject.php";
require_once "InitData.php";
class MapEntity extends GameObject implements InitData{

    public $boss_id = "";

    public $list_mob_id = array();

    public $rate_mob = array();

    public $rank = 0;

    public $reward_id = "";

    public $boss_reward_id = null;

    public $map_pk = false;

    public $force = 0;

    public function createData($mapEntity){
        if(isset($mapEntity->id)) $this->id = $mapEntity->id;
        if(isset($mapEntity->docType)) $this->doc_type = $mapEntity->docType;
        if(isset($mapEntity->name)) $this->name = $mapEntity->name;
        if(isset($mapEntity->code)) $this->code = $mapEntity->code;
        if(isset($mapEntity->level)) $this->level = $mapEntity->level;
        if(isset($mapEntity->parent)) $this->parent = $mapEntity->parent;
        if(isset($mapEntity->bossId)) $this->boss_id = $mapEntity->bossId;
        if(isset($mapEntity->listMobId)) $this->list_mob_id = $mapEntity->listMobId;
        if(isset($mapEntity->rateMob)) $this->rate_mob = $mapEntity->rateMob;
        if(isset($mapEntity->rank)) $this->rank = $mapEntity->rank;
        if(isset($mapEntity->rewardId)) $this->reward_id = $mapEntity->rewardId;
        if(isset($mapEntity->bossRewardId)) $this->boss_reward_id = $mapEntity->bossRewardId;
        if(isset($mapEntity->mapPk)) $this->map_pk = $mapEntity->mapPk;
        if(isset($mapEntity->force)) $this->force = $mapEntity->force;
        return $this;
    }
}