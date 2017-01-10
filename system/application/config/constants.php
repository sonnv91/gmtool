<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('BASE_DIR', $_SERVER["DOCUMENT_ROOT"]);
define('DIR_STRUCT_DATA', BASE_DIR."/system/application/data/");
define('TEMPLATE', "template/temp");
//define('API_URL', 'http://localhost:9000/');
define('API_URL', 'http://sk.ganetstudio.com/');
define('API_URL_DEV', 'http://dev.ganetstudio.com/');
define('API_URL_EN', 'http://en.ganetstudio.com/');
define('API_GAME', 'http://vl.ganetstudio.com/');
define('DIR_CONFIG_MENU_FILE',BASE_DIR."/system/application/config/menu.json");
define('DIR_CONFIG_PERMISSION_FILE',BASE_DIR."/system/application/config/permission/");
define('DIR_COMMON_BASE', BASE_DIR."/system/application/common/");
define('FILE_ENUMS', BASE_DIR."/system/application/data/AutoVLEnums.php");
define('MILISECOND_GMT7', 25200000);
define('RECORD_PER_PAGE', 20);
define('COIN_HOARD', "55bb00338aa218639f561835");
define('COIN_HOARD_DAILY', "55bb00338aa218639f561836");

/* End of file constants.php */
/* Location: ./application/config/constants.php */