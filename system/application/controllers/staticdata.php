<?php

class StaticData extends BaseController
{

    function __construct()
    {
        parent::__construct();
        $this->datas["active_menu"] = __CLASS__;
    }

    function items()
    {
        $this->isAllowAccess();
        $docType = $this->uri->segment(3) ? $this->uri->segment(3) : "WEAPON";
        $items = (object)array("cache_data"=> array());
        if($docType == "HOANG_KIM"){
            foreach($this->config->item("EQUIPMENT") as $equip){
                $base = $this->request(array("doc_type" => $equip), $this->api["gmtool_get_base"]);
                foreach($base->cache_data as $b){
                    if(isset($b->equipmentType) && $b->equipmentType == "HOANG_KIM"){
                        $items->cache_data[] = $b;
                    }
                }
            }
        }else{
			$items = $this->request(array("doc_type" => $docType), $this->api["gmtool_get_base"]);				
        }
        
		$option_basic = $this->request(array("doc_type" => "OPTION_BASIC"), $this->api["gmtool_get_base"]);
		$option_extra = $this->request(array("doc_type" => "OPTION_EXTRA"), $this->api["gmtool_get_base"]);
		$option_magic = $this->request(array("doc_type" => "OPTION_MAGIC"), $this->api["gmtool_get_base"]);
		$option_unique = $this->request(array("doc_type" => "OPTION_UNIQUE"), $this->api["gmtool_get_base"]);
		
		$options = array_merge($option_basic->cache_data, $option_extra->cache_data, $option_magic->cache_data, $option_unique->cache_data);
		
        $rewards = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);
        $itemUsage = $this->request(array("doc_type" => "ITEM_USAGE"), $this->api["gmtool_get_base"]);
        $this->datas["sub"] = "static_data/items";
        $data = array(
            "items" => $items,
            "docType" => $docType,
            "rewards"  => $rewards,
            "itemUsage" => $itemUsage,
			"options" => $options
        );
        $this->datas["data"] = array(
            "title" => "Vật phẩm",
            "data" => $data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    function itemsStatic(){
        $item_static = $this->request(array("doc_type" => "BASE_STATIC_ITEM"), $this->api["gmtool_get_base"]);
        $option_basic = $this->request(array("doc_type" => "OPTION_BASIC"), $this->api["gmtool_get_base"]);
        $option_extra = $this->request(array("doc_type" => "OPTION_EXTRA"), $this->api["gmtool_get_base"]);
        $option_magic = $this->request(array("doc_type" => "OPTION_MAGIC"), $this->api["gmtool_get_base"]);
        $option_unique = $this->request(array("doc_type" => "OPTION_UNIQUE"), $this->api["gmtool_get_base"]);
        $option_set = $this->request(array("doc_type" => "OPTION_SET"), $this->api["gmtool_get_base"]);
        $simpleDataItem = $this->getSimpleDataItem();
        $this->datas["sub"] = "static_data/item_static";
        $data = array(
            "items" => $item_static,
            "simpleDataItem" => $simpleDataItem,
            "option_basic" => $option_basic,
            "option_extra" => $option_extra,
            "option_magic" => $option_magic,
            "option_unique" => $option_unique,
            "option_set" => $option_set,
        );
        $this->datas["data"] = array(
            "title" => "Vật phẩm",
            "data" => $data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    function skills()
    {
        $this->isAllowAccess();
        $dataRequest = array("doc_type" => "BASE_SKILL");
        $data = $this->request($dataRequest, $this->api["gmtool_get_base"]);
        $this->datas["sub"] = "static_data/skills";
        $this->datas["data"] = array(
            "title" => "Tuyệt kỹ",
            "data" => $data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    function maps()
    {
        $this->isAllowAccess();
        $dataRequest = array("doc_type" => "MAP_GROUP");
        $data = $this->request($dataRequest, $this->api["gmtool_get_map_group"]);
        $this->datas["sub"] = "static_data/maps";
        $this->datas["data"] = array(
            "title" => "GROUP MAP",
            "data" => $data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    function mapDetail()
    {
        $this->datas["sub"] = "static_data/map_detail";
        $baseCharacter = $this->request(array("doc_type" => "BASE_CHARACTER"), $this->api["gmtool_get_base"]);
        $mobs = $this->request(array("doc_type" => "MOB"), $this->api["gmtool_get_base"]);
        $data = $this->get($this->api["gmtool_get_maps"]);
		$this->load->model('log_map_complete_dao');
		// foreach($data->maps as $map){
			// if($map->level < 82){
				// $log = $this->log_map_complete_dao->findByMapId($map->id);
				// if(!isset($log->owner)) echo $map->id."<br/>";		
			// }
		// }
		// die;

        $data->mobs = $mobs->cache_data;

        $baseCharInfo = array();
        foreach($baseCharacter->cache_data as $dat){
            $baseCharInfo[$dat->id] = $dat->name;
        }
        $this->datas["data"] = array(
            "title" => "Danh sách map",
            "data" => $data,
            "baseChar" => $baseCharInfo
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    function characters()
    {
        $dataRequest = array("doc_type" => "BASE_CHARACTER");
        $data = $this->request($dataRequest, $this->api["gmtool_get_base"]);
        $this->datas["sub"] = "static_data/character";
        $this->datas["data"] = array(
            "title" => "Base Character",
            "data"  => $data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    function mobs()
    {
        $mobs = $this->request(array("doc_type" => "MOB"), $this->api["gmtool_get_base"]);
        $maps = $this->mapPositionOfMob();
        $map_config = $this->request(array("doc_type" => "MAP"), $this->api["gmtool_get_base"]);
        $baseChar = $this->request(array("doc_type" => "BASE_CHARACTER"), $this->api["gmtool_get_base"]);
        $baseSkill = $this->request(array("doc_type" => "BASE_SKILL"), $this->api["gmtool_get_base"]);
        $skillMob = $this->request(array("doc_type" => "SKILL"), $this->api["gmtool_get_base"]);
        $baseSkillFillter = $this->filterSkillName($baseSkill->cache_data);
        $data = array(
            "mobs" => $mobs,
            "maps" => $maps,
            "map_config" => $map_config,
            "baseChar" => $baseChar,
            "skills"   => $skillMob,
            "baseSkill" => $baseSkillFillter
        );

        $this->datas["sub"] = "static_data/mobs";
        $this->datas["data"] = array(
            "title" => "Mob",
            "data"  => $data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    function generateMob(){

        $this->load->library("AutoVL_GenMob");
        $map = $this->request(array("doc_type" => "MAP", "id" => $_POST["map_id"]), $this->api["gmtool_get_entity"]);
        $baseSkill = $this->request(array("doc_type" => "BASE_SKILL"), $this->api["gmtool_get_base"]);
        $skillMob = $this->request(array("doc_type" => "SKILL"), $this->api["gmtool_get_base"]);

        $skillFillter = $this->fillterSkill($baseSkill->cache_data);
        $skillMobFillter = $this->fillterMobSkill($skillMob->cache_data);

        $this->autovl_genmob->metaForce = $map->entity->force;

        /** create new mob **/
        foreach($_POST["base_char_id"] as $baseId){
            $baseChar = $this->request(array("doc_type" => "BASE_CHARACTER", "id" => $baseId), $this->api["gmtool_get_entity"]);
            $dataMob = $this->autovl_genmob->createData();
            $dataMob["doc_type"] = "MOB";
            $dataMob["name"] = $baseChar->entity->name;
            $dataMob["code"] = $baseChar->entity->code;
            $dataMob["level"] = max(round($map->entity->level/2), 1);
            $dataMob["parent"] = $baseChar->entity->id;
            $dataMob["left_frame"] = $this->getRandomFrameSkill($skillMobFillter, $skillFillter, $baseChar->entity->characterClass, 'DAMAGE', intval($_POST["num_atk_skill"]), 1);
            $dataMob["right_frame"] = $this->getRandomFrameSkill($skillMobFillter, $skillFillter, $baseChar->entity->characterClass, 'BONUS', intval($_POST["num_bonus_skill"]), 1);
            $mob = bindFromRequest("MobEntity", $dataMob);

            $responseSaveMob = $this->request($mob, $this->api["gmtool_mob_save"]);
            $newListMobId[] = $responseSaveMob->entity->id;
        }

        /** remove old mob **/
        if(isset($map->entity->listMobId)){
            foreach($map->entity->listMobId as $mobId){
                $this->request(array("doc_type"=>"MOB", "id"=>$mobId), $this->api["gmtool_entity_delete"]);
            }
        }

        /** set new mob to map **/
        $map->entity->listMobId = $newListMobId;
        $map->entity->rateMob = computeAverageRate(count($newListMobId));

        /** save map **/
        $mapRequest = createRequestFromEntity("MapEntity", $map->entity);
        $this->request($mapRequest, $this->api["gmtool_map_save"]);

        redirect("data/mobs");
    }

    public function saveMob(){
        $_POST["boss"] = isset($_POST["boss"]);
        $baseChar = $this->request(array("doc_type" => "BASE_CHARACTER", "id" => $_POST["parent"]), $this->api["gmtool_get_entity"]);
        $_POST["name"] = $baseChar->entity->name;
        $mob = bindFromRequest("MobEntity", $_POST);
        $response = $this->request($mob, $this->api["gmtool_mob_save"]);
        echo json_encode($response->entity);
        //redirect("data/mobs");
    }

    function rewards()
    {
        $this->datas["sub"] = "static_data/rewards";
        $rewards = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);
        $material = $this->request(array("doc_type" => "MATERIAL"), $this->api["gmtool_get_base"]);
        $usableItem = $this->request(array("doc_type" => "USABLE_ITEM"), $this->api["gmtool_get_base"]);
        $baseItem = $this->get($this->api["gmtool_get_base_item"]);
        $data = array(
            "rewards" => $rewards,
            "material" => $material,
            "usableItem" => $usableItem,
            "baseItem" => $baseItem
        );
        $this->datas["data"] = array(
            "title" => "GROUP MAP",
            "data"  => $data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    function equipmentOption(){
        $this->datas["sub"] = "static_data/options";
        $docType = $this->uri->segment(3) ? $this->uri->segment(3) : "OPTION_BASIC";
        $options = $this->request(array("doc_type" => $docType), $this->api["gmtool_get_base"]);
        $skills = $this->request(array("doc_type" => "BASE_SKILL"), $this->api["gmtool_get_base"]);
        $data = array(
            "options" => $options,
            "docType" => $docType,
            "skills" => $skills
        );
        $this->datas["data"] = array(
            "title" => "Thuộc tính trang bị",
            "data"  => $data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    function optionSet(){
        $this->datas["sub"] = "static_data/options_set";
        $options = $this->request(array("doc_type" => "SET_OPTION_CONFIG"), $this->api["gmtool_get_base"]);
        $option_set = $this->request(array("doc_type" => "OPTION_SET"), $this->api["gmtool_get_base"]);
        $data = array(
            "options" => $options,
            "option_set" => $option_set,
        );
        $this->datas["data"] = array(
            "title" => "Thuộc tính set đồ",
            "data"  => $data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    function vips(){
        $this->datas["sub"] = "static_data/vips";
        $data = $this->request(array("doc_type"=>"VIP"), $this->api["gmtool_get_base"]);
        usort($data->cache_data, "vipSort");
        $this->datas["data"] = array(
            "title" => "VIP",
            "data" => $data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    function versionData(){
        $this->datas["sub"] = "static_data/cdn_version";
        $versionData = array();
        foreach($this->config->item("CDN") as $cdn){
            $ver = $this->request(array("doc_type" => $cdn), $this->api["gmtool_get_base"]);
			// var_dump($versionData);die;
            $versionData = array_merge($versionData, $ver->cache_data);
        }

        $this->datas["data"] = array(
            "title" => "Version game data",
            "data"  => $versionData
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function achievements(){
        $achievements = $this->request(array("doc_type" => "ACHIEVEMENT"), $this->api["gmtool_get_base"]);
        usort($achievements->cache_data, "achievementActionSort");
        $reward = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);
        $this->datas["sub"] = "static_data/achievements";
        $this->datas["data"] = array(
            "title" => "Thành tựu",
            "data"  => $achievements->cache_data,
            "rewards" => $reward->cache_data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function helpData(){
        $helps = $this->request(array("doc_type" => "HELP"), $this->api["gmtool_get_base"]);

        $this->datas["sub"] = "static_data/help";
        $this->datas["data"] = array(
            "title" => "Trợ giúp",
            "helps"  => $helps->cache_data
        );
        $this->load->view(TEMPLATE, $this->datas);

    }

    public function saveHelpData(){
        $help = bindFromRequest("HelpEntity", $_POST);
        $response = $this->request($help, $this->api["gmtool_help_save"]);
        echo json_encode($response);
        //redirect("data/helps");
    }

    public function saveAchievement(){
        $achievement = bindFromRequest("AchievementEntity", $_POST);
        //echo json_encode($achievement);die;
        $response = $this->request($achievement, $this->api["gmtool_achievement_save"]);
        echo json_encode($response->entity);
        //redirect("data/achievements");
    }

    function saveVip(){
        $vip = bindFromRequest("VipEntity", $_POST);
        $response = $this->request($vip, $this->api["gmtool_vip_save"]);
        echo json_encode($response);
        //redirect("data/vips");
    }

    function saveCdn(){
        $postData = $_POST;
        $postData['mandatory'] = isset($_POST['mandatory']);
        $cdn = bindFromRequest("CdnEntity", $postData);
        $this->request($cdn, $this->api["gmtool_cdn_save"]);
        redirect("/data/version");
    }

    function saveSetOption(){
        $postData = $_POST;
        if(isset($postData["attr_type"])){
            for($i = 0; $i < count($postData["attr_type"]); $i++){
                $option = (object)array(
                    "parent" => $postData["attr_parent"][$i],
                    "value" => $postData["attr_value"][$i],
                    "type" => $postData["attr_type"][$i]
                );
                $postData["options"][] = $option;
            }
        }
        $options_set = bindFromRequest("SetOption", $postData);
        $this->request($options_set, $this->api["gmtool_option_set_save"]);
        redirect("/data/options/set");
    }
    function saveOption(){
        $postData = $_POST;
        $postData["percent"] = isset($_POST["percent"]);
        if(!isset($postData["stat"]) || $postData["stat"] == ""){$postData["stat"] = null;}
        if(!isset($postData["skill_id"]) || $postData["skill_id"] == ""){$postData["skill_id"] = null;}
        $option = bindFromRequest("OptionEntity", $postData);
        //echo json_encode($option);die;
        $this->request($option, $this->api["gmtool_option_save"]);
        redirect("/data/options/".$option->doc_type);
    }

    function saveMapGroup()
    {
        $mapGroup = bindFromRequest("MapGroupEntity", $_POST);
        $response = $this->request($mapGroup, $this->api["gmtool_map_group_save"]);
        echo json_encode($response->entity);
        //redirect("/data/maps");
    }

    function saveBaseSkill()
    {
        $postData = $_POST;
        if (isset($postData["effect_damage_type"]) && count($postData["effect_damage_type"]) > 0) {
            $spellEffects = array();
            for ($i = 0; $i < count($postData["effect_damage_type"]); $i++) {
                $spellEffect["damageType"] = $postData["effect_damage_type"][$i];
                $spellEffect["name"] = $postData["effect_name"][$i] == "" ? $this->lang->line($postData["effect_damage_type"][$i]) : $postData["effect_name"][$i];
                $spellEffect["stat"] = $postData["effect_stat"][$i];
                if($postData["effect_degree"][$i] != "") $spellEffect["degree"] = $postData["effect_degree"][$i];
                if($postData["effect_duration"][$i] != "") $spellEffect["duration"] = $postData["effect_duration"][$i];
                if($postData["effect_growth"][$i] != "") $spellEffect["growth"] = $postData["effect_growth"][$i];

                array_push($spellEffects, $spellEffect);
            }
        }
        if (isset($spellEffects)) $postData["spell_effects"] = $spellEffects;

        $growth = (object)array();
        if (isset($postData["skill_growth"]) && count($postData["skill_growth"]) > 0) {
            foreach ($postData["skill_growth"] as $g) {
                $growth->$g = $postData[$g];
            }
        }

        if (count((array)$growth) > 0) {
            $postData["growth"] = $growth;
        }
		$postData["require_train"] = isset($postData["require_train"]);
        $baseSkill = bindFromRequest("BaseSkillEntity", $postData);
        //echo json_encode($baseSkill);die;
        $response = $this->request($baseSkill, $this->api["gmtool_skill_save"]);
        echo json_encode($response->entity);
        //redirect("/data/skills");
    }

    function saveMap()
    {
        $postData = $_POST;
        $postData["map_pk"] = (isset($_POST["map_pk"]) && $_POST["map_pk"] == "on");
        if (isset($postData["list_mob_id"]) && count($postData["list_mob_id"]) > 0) {
            foreach ($postData["list_mob_id"] as $g) {
                $rate_mob[] = $postData[$g];
            }
        }
        $postData["rate_mob"] = $rate_mob;
        $map = bindFromRequest("MapEntity", $postData);
        // echo json_encode($map);die;
        $response = $this->request($map, $this->api["gmtool_map_save"]);
        echo json_encode($response->entity);
        redirect("/data/map/detail/" . $_POST["parent"]);
    }

    function saveBaseCharacter(){
        $postData = $_POST;
        $postData["female"] = isset($postData["sex"]) && $postData["sex"][0] == 0;
        $postData["level"] = 1;
        $character =  bindFromRequest("BaseCharacterEntity", $postData);

        $response = $this->request($character, $this->api["gmtool_character_save"]);
        echo json_encode($response->entity);
        //redirect("/data/characters");
    }

    function saveItem(){
        $postData = $_POST;
        $postData["can_upgrade"] = isset($postData["can_upgrade"]);
        $postData["visible_doc"] = isset($postData["visible_doc"]);
        $postData["character_class"] = (isset($postData["character_class"]) && $postData["character_class"] != "") ? $postData["character_class"] : null;
        $postData["equipment_type"] = (isset($postData["equipment_type"]) && $postData["equipment_type"] != "") ? $postData["equipment_type"] : null;
        $postData["reward_id"] = (isset($postData["reward_id"]) && $postData["reward_id"] != "") ? $postData["reward_id"] : null;
        $postData["usage_id"] = (isset($postData["usage_id"]) && $postData["usage_id"] != "") ? $postData["usage_id"] : null;
        $postData["set_id"] = (isset($postData["set_id"]) && $postData["set_id"] != "") ? $postData["set_id"] : null;
        $postData["sex"] = (isset($postData["sex"]) && $postData["sex"] != "") ? $postData["sex"] : null;
        $postData["stat_type"] = (isset($postData["stat_type"]) && $postData["stat_type"] != "") ? intval($postData["stat_type"]) : null;
        $postData["option_id"] = (isset($postData["option_id"]) && $postData["option_id"] != "") ? $postData["option_id"] : null;
        $postData["valid_equip"] = (isset($postData["valid_equip"]) && $postData["valid_equip"] != "") ? $postData["valid_equip"] : null;
        $item =  bindFromRequest("ItemEntity", $postData);
        // echo json_encode($item);die;
        $this->request($item, $this->api["gmtool_item_save"]);
        // if($item->equipment_type == "HOANG_KIM") redirect("/data/items/HOANG_KIM");
        // redirect("/data/items/".$item->doc_type);
    }

    function saveItemStatic(){
        $postData = $_POST;
        $simpleDataItme = $this->getSimpleDataItem();
        $postData["doc_type"] = $simpleDataItme[$postData["item_parent"]]["doc_type"];
        if(isset($postData["attr_type"])){
            for($i = 0; $i < count($postData["attr_type"]); $i++){
                $option = (object)array(
                    "parent" => $postData["attr_parent"][$i],
                    "value" => $postData["attr_value"][$i],
                    "type" => $postData["attr_type"][$i]
                );
                $postData["options"][] = $option;
            }
        }
        $static_item = bindFromRequest("BaseStaticItem",$postData);
        $response = $this->request($static_item, $this->api["gmtool_item_static_save"]);
        echo json_encode($response->entity);
        //redirect("/data/items/static");
    }

    function saveReward(){
        $postData = $_POST;
        if($postData["rate_drop"][0] == 0){
            $postData["random_equipment"] = null;
        }else{
            $postData["random_equipment"] = (object)array(
                "fixedLevel"=> $postData["fixed_level"],
                "rateQuality"=> $postData["rate_quality"],
                "rateEquipment"=> $postData["rate_equipment"],
                "rateRank"=> $postData["rate_rank"],
            );
        }
        //$postData["usable_items"] = null;
        if(isset($postData["usable_item_id"])){

            foreach($postData["usable_item_id"] as $id){
                $rateUsableItem[] = isset($postData["usable_item_rate-".$id]) ? intval($postData["usable_item_rate-".$id]) : 0;
                $qttUsableItem[] = isset($postData["usable_item_qtt-".$id]) ? intval($postData["usable_item_qtt-".$id]) : 1;
            }
            $postData["usable_items"] = (object)array(
                "random" => isset($postData["usable_item_random"]),
                "rateDrop" => $rateUsableItem,
                "quantityDrop" => $qttUsableItem,
                "baseItemId" => $postData["usable_item_id"]
            );
        }else{
            $postData["usable_item"] = null;
        }

        if(isset($postData["static_item_id"])){

            foreach($postData["static_item_id"] as $id){
                $rateStaticItem[] = isset($postData["static_item_rate-".$id]) ? intval($postData["static_item_rate-".$id]) : 0;
                $qttStaticItem[] = isset($postData["static_item_qtt-".$id])? intval($postData["static_item_qtt-".$id]) : 1;
            }
            $postData["static_equipment"] = (object)array(
                "random" => isset($postData["static_random"]),
                "rateDrop" => $rateStaticItem,
                "quantityDrop" => $qttStaticItem,
                "baseItemId" => $postData["static_item_id"]
            );
        }else{
            $postData["static_equipment"] = null;
        }

        if(isset($postData["material_item_id"])){

            foreach($postData["material_item_id"] as $id){
                $rateMaterialItem[] = isset($postData["material_rate-".$id]) ? intval($postData["material_rate-".$id]) : 0;
                $qttMaterialItem[] = isset($postData["material_qtt-".$id]) ? intval($postData["material_qtt-".$id]) : 1;
            }

            $postData["material_items"] = (object)array(
                "random" => isset($postData["material_random"]),
                "rateDrop" => $rateMaterialItem,
                "quantityDrop" => $qttMaterialItem,
                "baseItemId" => $postData["material_item_id"]
            );
        }else{
            $postData["material_items"] = null;
        }
        $reward = bindFromRequest("RewardEntity", $postData);
        //echo json_encode($reward);die;
        $response = $this->request($reward, $this->api["gmtool_reward_save"]);
        echo json_encode($response->entity);
    }

    public function viewPartyConfig(){
        $mobList = $this->get($this->api["gmtool_get_basic_mob"]);
        $partyConfig = $this->request(array("doc_type" => "PARTY_ROOM"), $this->api["gmtool_get_base"]);
        $rewards = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);

        $this->datas["sub"] = "static_data/party_config";
        $this->datas["data"] = array(
            "title" => "Mob",
            "mobs" => $mobList->mobs,
            "configs" => $partyConfig->cache_data,
            "rewards" => $rewards->cache_data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function savePartyConfig(){

        $postData = $_POST;
        if(isset($_POST["is_boss"])) $postData["is_boss"] = true;

        $partyConfig = bindFromRequest('PartyConfig', $postData);
        $data = $this->request($partyConfig, $this->api["gmtool_party_save"]);
        echo json_encode($data->entity);
    }

    public function viewPartyAdvanced(){
        $mobList = $this->get($this->api["gmtool_get_basic_mob"]);
        $partyConfig = $this->request(array("doc_type" => "PARTY_ROOM_ADVANCED"), $this->api["gmtool_get_base"]);
        $rewards = $this->request(array("doc_type" => "REWARD"), $this->api["gmtool_get_base"]);

        $this->datas["sub"] = "static_data/party_advanced";
        $this->datas["data"] = array(
            "title" => "Viêm Đế",
            "mobs" => $mobList->mobs,
            "configs" => $partyConfig->cache_data,
            "rewards" => $rewards->cache_data
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function savePartyAdvanced(){

        $partyConfig = getDataRequest('RequestPartyAdvanced', $_POST);
        $data = $this->request($partyConfig, $this->api["gmtool_party_advanced_save"]);
        echo json_encode($data->entity);
    }

    public function optionRates(){
        $optionRates = $this->request(array("doc_type" => "CLAZZ_RATE_OPTION"),$this->api["gmtool_get_base"]);
        //$optionRates = array();
        $optionBasic = $this->request(array("doc_type" => "OPTION_BASIC"),$this->api["gmtool_get_base"]);
        $optionExtra = $this->request(array("doc_type" => "OPTION_EXTRA"),$this->api["gmtool_get_base"]);
        //$optionMagic = $this->request(array("doc_type" => "OPTION_MAGIC"),$this->api["gmtool_get_base"]);
        $optionUnique = $this->request(array("doc_type" => "OPTION_UNIQUE"),$this->api["gmtool_get_base"]);
        $this->datas["sub"] = "static_data/option_rate";

        $this->datas["data"] = array(
            "title" => "Options",
            "optionRates" => $optionRates->cache_data,
            "optionBasic" => $optionBasic->cache_data,
            "optionExtra" => $optionExtra->cache_data,
            //"optionMagic" => $optionMagic->cache_data,
            "optionUnique" => $optionUnique->cache_data,
        );
		// echo json_encode($this->datas["data"]);die;
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function saveOptionRate(){
//        echo json_encode($_POST);
        if(isset($_POST["option_basic"])){
            $rateOptionBasic = array();
            foreach($_POST["option_basic"] as $id){
                $rateOptionBasic[] = intval($_POST["option_basic_rate_".$id]);
            }
            $optionRateBasic = (object) array(
                "optionType" => "OPTION_BASIC",
                "optionIds" => $_POST["option_basic"],
                "rates" => $rateOptionBasic
            );

            $_POST["option_rates"][] = $optionRateBasic;
        }
        if(isset($_POST["option_extra"])){
            $rateOptionExtra = array();
            foreach($_POST["option_extra"] as $id){
                $rateOptionExtra[] = intval($_POST["option_extra_rate_".$id]);
            }
            $optionRateExtra = (object) array(
                "optionType" => "OPTION_EXTRA",
                "optionIds" => $_POST["option_extra"],
                "rates" => $rateOptionExtra
            );

            $_POST["option_rates"][] = $optionRateExtra;
        }
        /*if(isset($_POST["option_magic"])){
            $rateOptionMagic = array();
            foreach($_POST["option_magic"] as $id){
                $rateOptionMagic[] = $_POST["option_magic_rate_".$id];
            }
            $optionRateMagic = (object) array(
                "optionType" => "OPTION_MAGIC",
                "optionIds" => $_POST["option_magic"],
                "rates" => $rateOptionMagic
            );

            $_POST["option_rates"][] = $optionRateMagic;
        }*/
        if(isset($_POST["option_unique"])){
            $rateOptionUnique = array();
            foreach($_POST["option_unique"] as $id){
                $rateOptionUnique[] = intval($_POST["option_unique_rate_".$id]);
            }
            $optionRateUnique = (object) array(
                "optionType" => "OPTION_UNIQUE",
                "optionIds" => $_POST["option_unique"],
                "rates" => $rateOptionUnique
            );

            $_POST["option_rates"][] = $optionRateUnique;
        }
        $request = getDataRequest('RequestOptionRate', $_POST);
        echo json_encode($request);
        $data = $this->request($request, $this->api["gmtool_option_rate_save"]);
        redirect('data/rate_option');
    }

    public function appleReview(){
        $config = $this->request(array("doc_type" => "APPLE_REVIEW"),$this->api["gmtool_get_base"]);
        $this->datas["sub"] = "static_data/apple_review";
		// echo json_encode($config);die;

        $this->datas["data"] = array(
            "title" => "APPLE REVIEW CONFIG",
            "config" => $config->cache_data[0]
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function saveAppleReview(){
        $_POST["giftcode"] = isset($_POST["giftcode"]) ? true : false;
        $_POST["review"] = isset($_POST["review"]) ? true : false;
        $request = getDataRequest('RequestAppleReview', $_POST);
		// echo json_encode($request);die;
        $this->request($request, $this->api["gmtool_apple_review_save"]);
    }

    function deleteCacheData()
    {
        if (count($_POST) < 2) {
            show_error("REQUEST FAILED", 500, 10001);
        }
        //var_dump($_POST);
        $this->request($_POST, $this->api["gmtool_entity_delete"]);
        if(isset($_POST["redirect"])) redirect($_POST["redirect"]);
    }

    private function filterSkillName($skills){
        $skillFillter = array();
        foreach($skills as $skill){
            $skillFillter[$skill->id]["name"] = $skill->name;
            $skillFillter[$skill->id]["type"] = $skill->type;
            $skillFillter[$skill->id]["characterClass"] = $skill->characterClass;
        }
        return $skillFillter;
    }

    private function fillterSkill($skills){
        $skillFillter = array();
        foreach($skills as $skill){
            foreach($this->config->item('CHARACTER_CLASS') as $char){
                if($skill->characterClass == $char){
                    if($skill->type == 'DAMAGE') $skillFillter[$char]['DAMAGE'][] = $skill;
                    if($skill->type == 'BONUS') $skillFillter[$char]['BONUS'][] = $skill;
                    break;
                }
            }
        }
        return $skillFillter;
    }

    private function fillterMobSkill($mobSkill){
        $mobSkilFillter = array();
        for($i = 1; $i <= 20; $i++){
            foreach($mobSkill as $skill){
                if($skill->level == $i){
                    $mobSkilFillter[$i][$skill->parent][] = $skill;
                }
            }
        }
        return $mobSkilFillter;
    }

    private function getRandomFrameSkill($mobSkilFillter, $skillFillter, $characterClass, $type, $num, $level){
        $frame = array();
        if($num > 0){
            $num = min($num, count($skillFillter[$characterClass][$type]));
            $frameIndex = (array)array_rand($skillFillter[$characterClass][$type], $num);
            foreach($frameIndex as $f){
                if(isset($mobSkilFillter[$level][$skillFillter[$characterClass][$type][$f]->id])){
                    array_push($frame, $mobSkilFillter[$level][$skillFillter[$characterClass][$type][$f]->id][0]->id);
                }else{
                    $data = array(
                        "id" => "",
                        "parent" => $skillFillter[$characterClass][$type][$f]->id,
                        "level" => $level
                    );
                    $response = $this->request($data, $this->api["gmtool_mob_skill_save"]);
                    array_push($frame, $response->skill_id);
                }
            }
        }

        return $frame;
    }

    private function mapPositionOfMob(){
        $maps = $this->request(array("doc_type" => "MAP"), $this->api["gmtool_get_base"]);
        $position = array();
        foreach($maps->cache_data as $map){
            $mapName = $map->name;
            if(isset($map->mapPk)) $mapName .= "(PK)";
            $mapName .= " - ".$map->level;

            $position[$map->bossId] = $mapName;
            foreach($map->listMobId as $mobId){
                $position[$mobId] = $mapName;
            }
        }
        return $position;
        //echo json_encode($position);die;
    }
}