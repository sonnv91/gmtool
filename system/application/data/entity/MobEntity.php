<?php
require_once "base/GameObject.php";
class MobEntity extends GameObject{

    public $strength = 0;

    public $vitality = 0;

    public $dexterity = 0;

    public $energy = 0;

    public $boss = false;

    public $hand_force;
	
    public $damage_type;

    public $accuracy;

    public $health;

    public $mana;

    public $dodge_chance;

    public $critical;

    public $chimang;

    public $critical_resist;

    public $chimang_resist;

    public $physical_defense;

    public $poison_resist;

    public $water_resist;

    public $fire_resist;

    public $lighting_resist;

    public $ignore_physical_defense;

    public $ignore_poison_resist;

    public $ignore_water_resist;

    public $ignore_fire_resist;

    public $ignore_lighting_resist;

    public $left_frame = array();

    public $right_frame = array();
}