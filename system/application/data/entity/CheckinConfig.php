<?php
	require "./entity/BaseEntity.php";
	class CheckinConfig extends BaseEntity{
		
		public $createTime;
		
		public $endTime;
		
		public $listItem = array();
		
	}