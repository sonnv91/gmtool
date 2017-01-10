<?php
require_once "base/BaseEntity.php";
class PartyConfig extends BaseEntity{

    public $index = 1;

    public $list_mob = array();

    public $first_reward_id;

    public $reward_id;

    public $is_boss = false;

}