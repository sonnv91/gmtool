<?php
	require "GameObject.php";
	class BaseCharacterEntity extends GameObject{
		
		public $strength;
		
		public $vitality;
		
		public $dexterity;
		
		public $energy;

        public $character_name;
		
		public $health_perlevel;
		
		public $mana_perlevel;
		
		public $range;
		
		public $movement_speed;
		
		public $attack_speed;
		
		public $character_class;

		public $coefficient_strength;
		
		public $coefficient_dexterity;
		
		public $coefficient_vitality;
		
		public $coefficient_energy;
		
		public $coefficient_mana;
		
		public $coefficient_accuracy;
		
		public $coefficient_rescritical;
		
		public $coefficient_critical;
		
		public $physical_defense;
		
		public $poison_resist;
		
		public $water_resist;
		
		public $fire_resist;
		
		public $lighting_resist;

        public $female;

	}