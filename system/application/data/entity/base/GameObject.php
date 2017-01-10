<?php
	require_once "BaseEntity.php";
	class GameObject extends BaseEntity{

		public $name = "";
		
		public $description;
		
		public $code;
		
		public $level = 0;
		
		public $parent;


	}