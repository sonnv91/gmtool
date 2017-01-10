<?php
require_once "base/BaseEntity.php";
class ShopConfigEntity extends BaseEntity{

    public $type;

    public $parent_id;

    public $quantity = 1;

    public $rate = 0;

    public $base_coin = 0;

    public $base_silver = 0;

}