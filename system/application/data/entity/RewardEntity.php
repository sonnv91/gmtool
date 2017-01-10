<?php
require "base/BaseEntity.php";
class RewardEntity extends BaseEntity{

    public $name;

    public $type;

    public $exp = array(0, 0);

    public $silver = array(0, 0);

    public $coin = array(0, 0);

    public $credit = 0;

    public $tk_point = 0;
    public $sd_point = 0;

    public $number_item_receive = 0;

    /**
     * Ti le nhan duoc equipment, usable item, static item, material
     * Xac suat nay duoc xac dinh cho tung loai item nhan duoc
     * VD: [50, 60, 10, 100]
     */
    public $rate_drop = array(0, 0, 0, 0);

    /**
     * So luong nhan duoc tuong ung theo rateDrop
     */
    public $quantity_drop = array(0, 0, 0, 0);

    public $random_equipment;

    public $usable_items;

    public $material_items;

    public $static_equipment;

}