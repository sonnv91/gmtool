<?php
require "base/GameObject.php";
class BaseSkillEntity extends GameObject
{

    public $character_class = "";

    public $probability = 100;

    public $unlock = 0;

    public $range = 0;

    public $cost = 0;

    public $growth;

    public $skill_type = "";

    public $target = "";

    public $countdown = 0;
	
	public $require_train = false;

    public $spell_effects;

}

class SkillGrowth
{

    /**
     * Min sat thuong vat ly gia tang moi cap do
     */
    public $minPhysicalDamage = "minPhysicalDamage";

    /**
     * Max sat thuong vat ly gia tang moi cap do
     */
    public $maxPhysicalDamage = "maxPhysicalDamage";

    /**
     * Sat thuong co ban gia tang moi cap do
     */
    public $basicPhysicalDamage = "basicPhysicalDamage";

    /**
     * Chi mang
     */
    public $critical = "critical";

    /**
     * Pham vi
     */
    public $range = "range";


    /**
     * Phan damage
     */
    public $reflect = "reflect";

    /**
     * Choang
     */
    public $stun = "stun";

    /**
     * Noi luc
     */
    public $mana = "mana";

    /**
     * Khang tat ca
     */
    public $resistAll = "resistAll";

    /**
     * Min hoa sat
     */
    public $minFireDamage = "minFireDamage";

    /**
     * Max hoa sat
     */
    public $maxFireDamage = "maxFireDamage";

    /**
     * Noi luc tieu hao
     */
    public $cost = "cost";

    /**
     * Phong thu vat ly
     */
    public $physicalDefense = "physicalDefense";

    /**
     * Khang doc
     */
    public $poisonResist = "poisonResist";

    /**
     * Khang bang
     */
    public $waterResist = "waterResist";

    /**
     * Khang hoa
     */
    public $fireResist = "fireResist";

    /**
     * Khang loi
     */
    public $lightingResist = "lightingResist";

    /**
     * Sinh luc
     */
    public $health = "health";

    /**
     * Min doc sat
     */
    public $minPoisonDamage = "minPoisonDamage";

    /**
     * Max doc sat
     */
    public $maxPoisonDamage = "maxPoisonDamage";

    /**
     * Chinh xac
     */
    public $accuracy = "accuracy";

    /**
     * Ne tranh
     */
    public $dodgeChance = "dodgeChance";
}

class SpellEffect
{
    /**
     * Ten effect
     */
    public $name = "";
    /**
     * Loai
     */
    public $type = "";

    /**
     * Muc tieu
     */
    public $target = "";

    /**
     * Chi so tac dong
     */
    public $stat = "";

    /**
     * Muc do tac dong
     */
    public $degree = "";

    /**
     * Khoang thoi gian
     */
    public $duration = "0s";

    /**
     * Tang truong
     */
    public $growth = "";
}