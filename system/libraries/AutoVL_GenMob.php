<?php

class AutoVL_GenMob {

    /**
     * Tong luc
     */
    public $metaForce = 0;

    public $data = array();

    /**
     * Rate
     */
    private $basicStats     = 0.7;
    private $resistStats     = 0.2;
    private $uniqueStats    = 0.1;

    /**
     * Basic stats
     */
    private $strength       = 0.25;
    private $dexterity      = 0.1;
    private $vitality       = 0.45;
    private $energy         = 0.05;
    private $dodgeChance    = 0.08;
    private $critical       = 0.07;

    /**
     * Resist stats
     */
    private $physicalDefense    = 0.2;
    private $poisonResist      = 0.2;
    private $fireResist         = 0.2;
    private $waterResist        = 0.2;
    private $lightingResist     = 0.2;

    /**
     * Unique stats
     */
    private $ignorePhysicalDefense    = 0.2;
    private $ignorePoisonResist      = 0.2;
    private $ignoreFireResist         = 0.2;
    private $ignoreWaterResist        = 0.2;
    private $ignoreLightingResist     = 0.2;

    public function createData(){
        $this->data["strength"] = $this->getStrength();
        $this->data["vitality"] = $this->getVitality();
        $this->data["dexterity"] = $this->getDexterity();
        $this->data["energy"] = $this->getEnergy();
        $this->data["hand_force"] = $this->getHandForce();
        $this->data["accuracy"] = $this->getAccuracy();
        $this->data["health"] = $this->getHealth();
        $this->data["mana"] = $this->getMana();
        $this->data["dodge_chance"] = $this->getDodgeChance();
        $this->data["critical"] = $this->getCritical();
        $this->data["chimang"] = $this->getChimang();
        $this->data["critical_resist"] = $this->getCriticalResist();
        $this->data["chimang_resist"] = $this->getChimangResist();
        $this->data["physical_defense"] = $this->getPhysicalDefense();
        $this->data["poison_resist"] = $this->getPoisonResist();
        $this->data["water_resist"] = $this->getWaterResist();
        $this->data["fire_resist"] = $this->getFireResist();
        $this->data["lighting_resist"] = $this->getLightingResist();
        $this->data["ignore_physical_defense"] = $this->getIgnorePhysicalDefense();
        $this->data["ignore_poison_resist"] = $this->getIgnorePoisonResist();
        $this->data["ignore_water_resist"] = $this->getIgnoreWaterResist();
        $this->data["ignore_fire_resist"] = $this->getIgnoreFireResist();
        $this->data["ignore_lighting_resist"] = $this->getIgnoreLightingResist();
        $this->data["damage_type"] = $this->getDamageType();
        return $this->data;
    }

    public function getDamageType(){
        $damageType = array("FIRE", "WATER", "POISON", "LIGHTING", "PHYSICAL");
        $randIndex = rand(0, count($damageType) - 1);
        return $damageType[$randIndex];
    }

    public function getStrength(){
        return round($this->metaForce * $this->basicStats * $this->strength / 8);
    }

    public function getDexterity(){
        return round($this->metaForce * $this->basicStats * $this->dexterity / 8);
    }

    public function getVitality(){
        return round($this->metaForce * $this->basicStats * $this->vitality / 8);
    }

    public function getEnergy(){
        return round($this->metaForce * $this->basicStats * $this->energy / 8);
    }

    public function getDodgeChance(){
        return round($this->metaForce * $this->basicStats * $this->dodgeChance / 8);
    }

    public function getCritical(){
        return round($this->metaForce * $this->basicStats * $this->critical / 200);
    }

    public function getPhysicalDefense(){
        return round($this->metaForce * $this->resistStats * $this->physicalDefense / 8);
    }

    public function getPoisonResist(){
        return round($this->metaForce * $this->resistStats * $this->poisonResist / 8);
    }

    public function getFireResist(){
        return round($this->metaForce * $this->resistStats * $this->fireResist / 8);
    }

    public function getWaterResist(){
        return round($this->metaForce * $this->resistStats * $this->waterResist / 8);
    }

    public function getLightingResist(){
        return round($this->metaForce * $this->resistStats * $this->lightingResist / 8);
    }

    public function getIgnorePhysicalDefense(){
        return min(round($this->metaForce * $this->uniqueStats * $this->ignorePhysicalDefense / 20000, 2) * 100, 100);
    }

    public function getIgnorePoisonResist(){
        return min(round($this->metaForce * $this->uniqueStats * $this->ignorePoisonResist / 20000, 2) * 100, 100);
    }

    public function getIgnoreFireResist(){
        return min(round($this->metaForce * $this->uniqueStats * $this->ignoreFireResist / 20000, 2) * 100, 100);
    }

    public function getIgnoreWaterResist(){
        return min(round($this->metaForce * $this->uniqueStats * $this->ignoreWaterResist  / 20000, 2) * 100, 100);
    }

    public function getIgnoreLightingResist(){
        return min(round($this->metaForce * $this->uniqueStats * $this->ignoreLightingResist / 20000, 2) * 100, 100);
    }

    public function getHandForce(){
        return $this->getStrength();
    }

    public function getChimangResist(){
        return $this->getStrength();
    }

    public function getCriticalResist(){
        return $this->getEnergy();
    }

    public function getAccuracy(){
        return $this->getDexterity();
    }

    public function getHealth(){
        return $this->getVitality() * 10;
    }

    public function getMana(){
        return $this->getEnergy() * 2;
    }

    public function getChimang(){
        return $this->getStrength();
    }
}