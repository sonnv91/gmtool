<?php
require "base/BaseEntity.php";
class OptionEntity extends BaseEntity{

    public $name = "";

    public $coefficient = 0;

    public $coefficient_power;

    public $percent = false;

    public $stat;

    public $equipment_type = array();

    public $skill_id;

    public $rare;
}