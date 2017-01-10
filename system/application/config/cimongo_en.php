<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['host'] = "222.255.168.130";
$config['port'] = 27017;
$config['db'] = "evl";

$config['user'] = "";
$config['pass'] = "";

/*  
 * Defaults to FALSE. If FALSE, the program continues executing without waiting for a database response. 
 * If TRUE, the program will wait for the database response and throw a MongoCursorException if the update did not succeed.
*/
$config['query_safety'] = TRUE;

//If running in auth mode and the user does not have global read/write then set this to true
$config['db_flag'] = TRUE;

//consider these config only if you want to store the session into mongoDB
//They will be used in MY_Session.php
$config['sess_use_mongo'] = TRUE;
$config['sess_collection_name']	= 'ci_sessions';
 