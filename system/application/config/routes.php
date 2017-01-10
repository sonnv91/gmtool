<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['access/permission'] = "home/permission";

$route['user/login']                            = 'home/login';
$route['user/logout']                           = 'home/logout';

$route['drashboard']                            = 'drashboard/index';

$route['statistic/nru']                         = 'statistic/nru';
$route['statistic/dau']                         = 'statistic/dau';
$route['statistic/ccu']                         = 'statistic/ccu';
$route['statistic/niu']                         = 'statistic/niu';
$route['statistic/rev']                         = 'statistic/rev';
$route['statistic/rr']                          = 'statistic/testRR';
$route['statistic/pu']                          = 'statistic/pu';
$route['statistic/arpu']                        = 'statistic/arpu';
$route['statistic/arppu']                       = 'statistic/arppu';
$route['statistic/log_transaction']             = 'statistic/logTrans';
$route['statistic/log_usd']             		= 'statistic/logUSDTrans';

$route['user/list']                             = 'user/userList';

$route['data/items']                            = 'staticdata/items';
$route['data/items/static']                     = 'staticdata/itemsStatic';
$route['data/skills']                           = 'staticdata/skills';
$route['data/maps']                             = 'staticdata/maps';
$route['data/map/detail/([a-z0-9]+)']           = 'staticdata/mapDetail/$1';
$route['data/characters']                       = 'staticdata/characters';
$route['data/mobs']                             = 'staticdata/mobs';
$route['data/rewards']                          = 'staticdata/rewards';
$route['data/options/([A-Z_]+)']                = 'staticdata/equipmentOption/$1';
$route['data/options']                          = 'staticdata/equipmentOption';
$route['data/options/set']                      = 'staticdata/optionSet';
$route['data/vips']                             = 'staticdata/vips';
$route['data/version']                          = 'staticdata/versionData';
$route['data/items/([A-Z_]+)']                  = 'staticdata/items/$1';
$route['data/achievements']                     = 'staticdata/achievements';
$route['data/helps']                            = 'staticdata/helpData';
$route['data/shop']                             = 'shop/index';
$route['data/party']                            = 'staticdata/viewPartyConfig';
$route['data/party_advanced']                   = 'staticdata/viewPartyAdvanced';
$route['data/rate_option']                      = 'staticdata/optionRates';
$route['data/apple_review']                     = 'staticdata/appleReview';
$route['data/checkin']                          = 'checkin/index';

$route['tools/send_message']                    = 'tools/viewSendMessage';
$route['tools/activities']                      = 'tools/viewActivities';
$route['tools/server']                          = 'tools/serverList';
$route['tools/error_card/view']                 = 'tools/errorCardView';
$route['tools/error_card']                      = 'tools/errorCard';

$route['data/skill/save']                       = 'staticdata/saveBaseSkill';
$route['data/character/save']                   = 'staticdata/saveBaseCharacter';
$route['data/mobs/generate']                    = 'staticdata/generateMob';
$route['data/mob/save']                         = 'staticdata/saveMob';
$route['data/reward/save']                      = 'staticdata/saveReward';
$route['data/option/save']                      = 'staticdata/saveOption';
$route['data/option/set/save']                  = 'staticdata/saveSetOption';
$route['data/cdn/save']                         = 'staticdata/saveCdn';
$route['data/vip/save']                         = 'staticdata/saveVip';
$route['data/item/save']                        = 'staticdata/saveItem';
$route['data/item_static/save']                 = 'staticdata/saveItemStatic';
$route['data/achievement/save']                 = 'staticdata/saveAchievement';
$route['data/help/save']                        = 'staticdata/saveHelpData';
$route['data/party/save']                       = 'staticdata/savePartyConfig';
$route['data/party_advanced/save']              = 'staticdata/savePartyAdvanced';
$route['data/rate_option/save']                 = 'staticdata/saveOptionRate';
$route['data/apple_review/save']                = 'staticdata/saveAppleReview';
$route['data/checkin/save']                     = 'checkin/saveCheckinConfig';
$route['data/checkin/delete']                   = 'checkin/deleteCheckinConfig';
$route['data/shop/save']                        = 'shop/saveShopConfig';
$route['data/coin_hoard/save']                  = 'event/saveCoinHoardConfig';
$route['data/event_exchange/save']              = 'event/saveEventExchange';
$route['data/event_groupon/save']               = 'event/saveGrouponConfig';
$route['data/event_midautumn/save']             = 'event/saveMidAutumnConfig';
$route['data/clan_war']             			= 'tools/clanWarConfig';
$route['user/ban']               				= 'user/banUser';

$route['data/map/group/save']                   = 'staticdata/saveMapGroup';
$route['data/map/save']                         = 'staticdata/saveMap';
$route['data/server/save']                      = 'tools/saveServer';

$route['user/list/(:any)']                      = 'user/userlist/$1';
$route['user/save']                             = 'user/saveUser';

$route['event/hoard']                           = 'event/hoard';
$route['event/hoard_daily']                     = 'event/hoardDaily';
$route['event/tops']                            = 'event/hoard';
$route['event/exchange']                        = 'event/eventExchange';
$route['event/clan_boss']                       = 'event/eventClanBoss';
$route['event/groupon']                         = 'event/groupon';
$route['event/midautumn']                       = 'event/midautumn';

$route['event/conf/save']                       = 'event/saveConf';
$route['event/conf/delete']                     = 'event/deleteConf';
$route['event/clan_boss/reward']                = 'event/rewardTopClanBoss';

$route['logs/trans']                            = 'logs/logTrans';
$route['logs/coin']                             = 'logs/logCoin';
$route['logs/coin/(:any)']                      = 'logs/logCoin/$1';
$route['logs/inventory']                        = 'logs/logInventory';
$route['logs/inventory/(:any)']                 = 'logs/logInventory/$1';

$route['service/boss/start']                    = 'tools/startBoss';
$route['service/tongkim/start']                 = 'tools/startTongkim';
$route['reward/sync']                 			= 'home/rewardSync';

$route['crontab/top/bidding']                 	= 'crontab/setTopBidding';

$route['api/clan/info']                         = 'clan/getInfoClan';

$route['data/cache/delete']                     = 'staticdata/deleteCacheData';

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */