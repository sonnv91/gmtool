<?php
require_once 'base/BaseEntity.php';
class BaseStaticItem extends BaseEntity{

    public $item_parent;

    public $quantity = 1;

    public $quality = "WHITE";

    public $equipped;

    public $level = 1;

    public $level_upgrade = 0;

    public $options = null;

    public $equipment_type;
}