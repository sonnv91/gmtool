<?php
	function create_entity($class_name){
		$file = DIR_STRUCT_DATA."entity/".$class_name.".php";
		if(!file_exists($file)){
			$file = DIR_STRUCT_DATA."entity/base/".$class_name.".php";
		}
		
		require_once $file;
		$entity = new $class_name;
		return $entity;
	}
	
	function testLoad(){
		
	}