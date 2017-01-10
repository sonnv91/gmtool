<?php
	require "GameObject.php";
	class BaseItemEntity extends GameObject{
		
		public $quality;
		
		public $stack_size;
		
		public $can_upgrade;
		
		public $rank;
		
		public $require_level;

        public $sex = null;
        
        public $set_id = null;

        public $character_class = null;

        public $equipment_type = null;

        public $weapon_type = null;

        public $reward_id = null;

        public $usage_id = null;
		
		public $stat_type = null;
		
		public $value = 0;
		
		public $visible_doc = true;
		
		public $valid_equip = null;
		
		public $option_id = null;
	}