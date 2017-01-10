<?php
require_once "base/BaseEntity.php";
class VipEntity extends BaseEntity{

    public $vip;

    public $coin_require;

    public $max_fighting;

    public $max_buy_turn_boss_fighting;

    public $max_buy_turn_fast_fighting;

    public $max_turn_free_boss_clan_fighting;

    public $max_turn_dedicate = array(1,1,1,1);

    public $max_slot_shop;

    public $max_turn_party;

    public $max_turn_buy_silver;

    public $max_turn_phonglangdo;

    public $description;
}