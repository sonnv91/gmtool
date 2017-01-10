<?php
    $config["CHARACTER_CLASS"] = array(
        "THIEU_LAM", "DUONG_MON", "NGA_MY", "CAI_BANG", "VO_DANG", "NGU_DOC", "BOSS", "NONE"
    );

    $config["SKILL_TYPE"] = array(
        "DAMAGE", "BONUS"
    );

    $config["SPELL_TARGET"] = array(
        "SELF", "ENEMY", "TEAM"
    );

    $config["SKILL_GROWTH"] = array(
        "range",
        "cost",
        "countdown",
        "probability"
    );

    $config["QUALITY"] = array(
        "WHITE", "GREEN", "BLUE", "PURPLE", "YELLOW", "RED"
    );

    $config["ITEM_TYPE"] = array(
        "WEAPON", "HELM", "ARMOR", "BOOTS", "GLOVE", "BELT", "MOUNT", "NECKLACE", "JEWELRY", "RING", "USABLE_ITEM", "MATERIAL"
    );

    $config["SET_HOANGKIM"] = array(
        "PHUC_MA", "VO_GIAN", "DONG_CUU", "LANG_NHAC", "THIEN_QUANG", "KIM_PHONG", "THIEN_HOANG", "HIEP_COT", "NHU_TINH", "DINH_QUOC", "AN_BANG", "VO_DANH", "KIM_QUANG",
		"MINH_AO","U_LUNG","TU_KHONG","DICH_KHAI","VO_MA","CAP_PHONG","BANG_HAN","MONG_LONG"
    );

    $config["EQUIPMENT_TYPE"] = array(
        "NORMAL", "HUYEN_TINH", "HOANG_KIM"
    );

    $config["WEAPON_TYPE"] = array(
        "DAO", "KIEM", "THUONG", "CHUY", "BONG", "PHI_DAO", "NO", "PHI_TIEU"
    );

    $config["SKILL_STAT"] = array(
        "minDamage",
        "maxDamage",
        "percentDamage",
        // "percentFireDamage",
        // "percentLightingDamage",
        // "percentPoisonDamage",
        // "percentWaterDamage",
        // "resistPenetration",
        "resist",
        "dodgeChance",
        "stun",
        "chiDamage",
        "critical",
        "blockChiDamage",
        // "fire",
        // "water",
        // "poison",
        // "lighting",
        //"physicalDefense",
        "resistAll",
        "reflectionDamage",
        "accuracy",
        "hp",
        "mp",
        "luckyPoint",
        "retrieveHp",
        "retrieveMp",
        "speed",
        "attackSpeed",
        "blockSkill",
        "manaShield",
        "recruitHp",
        "recruitMp",
        "damagePercentHp",
        "damagePercentMaxHp",
        "dot",
        "slow",
        "decreaseDamageReflect",
		"decreaseDamageReflectPassive",
        "discardResist",
        "retrieveHpWhenDefend",
        "x3Damage",
        "x3DamageStun",
        "decreaseDamage",
        "timeStun",
        "rateStun"
        // "strength",
        // "dexterity",
        // "vitality",
        // "energy"
    );

    $config["DAMAGE_TYPE"] = array(
        "PHYSICAL",
        "ATTRIBUTE",
        "ALL",
        //"INCREASE",
        //"DECREASE",
        //"CRITICAL",
        "FIRE",
        "WATER",
        "POISON",
        "LIGHTING"
    );
    $config["MOB_DAMAGE_TYPE"] = array(
        "PHYSICAL",
        "FIRE",
        "WATER",
        "POISON",
        "LIGHTING"
    );
    $config["REWARD_TYPE"] = array(
        "REWARD_MAP",
        "REWARD_EVENT",
        "REWARD_QUEST",
        "REWARD_CONFIG",
        "REWARD_ITEM",
        "REWARD_TUTORIAL",
    );

    $config["EQUIPMENT_OPTION"] = array(
        "physicalDamage",
        "fireDamage",
        "lightingDamage",
        "poisonDamage",
        "waterDamage",
        "dodgeChance",
        "stun",
        "chiDamage",
        "blockChiDamage",
        "physicalDefense",
        "accuracy",
        "hp",
        "mp",
        "luckyPoint",
        "retrieveHp",
        "retrieveMp",
        "speed",
        "attackSpeed",
        "strength",
        "dexterity",
        "vitality",
        "energy",
        "resistFire",
        "resistWater",
        "resistPoison",
        "resistLighting",
        "resistAll",
        "critical",
        "discardPhysicalDefense",
        "discardResistFire",
        "discardResistWater",
        "discardResistPoison",
        "discardResistLighting",
        "pointSkill",
        "pointAllSkill",
        "recruitHp",
        "recruitMp",
    );

    $config["EQUIPMENT"] = array(
        "WEAPON",
        "ARMOR",
        "BOOTS",
        "GLOVE",
        "HELM",
        "JEWELRY",
        "NECKLACE",
        "RING",
        "BELT",
        "MOUNT"
    );
    $config["OPTIONS"] = array(
        "OPTION_BASIC",
        "OPTION_EXTRA",
        "OPTION_MAGIC",
        "OPTION_UNIQUE",
        "OPTION_SET"
    );

    $config["CDN"] = array(
        "CDN_APP",
        "CDN_ASSET",
        "CDN_DATA",
        "CDN_CHECK_IN",
        "CDN_BATTLE_CLIENT"
    );

    $config["CLIENT_TYPE"] = array(
        "IOS",
        "ANDROID",
        "WINDOWS"
    );

    $config["ACHIEVEMENT_TYPE"] = array(
        "LEVEL_UP",
        "JOIN_CLAN",
        "CREATE_CLAN",
        "MAKE_FRIEND",
        "JOIN_TONGKIM",
        "TONGKIM_ACHIEVEMENT",
        "FIGHT_TONGKIM",
        "JOIN_PHONGLANGDO",
        "KILL_BOSS_PHONGLANGDO",
        "RICHER",
        "JOIN_HOASON",
        "FIGHT_HOASON",
    );

    $config["HELP_TYPE"] = array(
        "SKILL_MENU",
        "QUEST_MENU",
        "TONGKIM",
        "PHONGLANGDO",
        "THOREN_THANBI",
        "HOASON",
        "THOREN",
        "BOSS_HOANGKIM",
        "EVENT",
        "CLAN",
        "NOTICE",
        "NAPXUTICHLUY",
        "MECUNGTHAMBAO",
        "RUONGTHANTAI",
        "NAPXUNHANQUA",
        "TANGLONGCAMDIA",
        "FOLLOWER",
        "ACHIEVEMENT",
        "DAILY_QUEST",
        "CLAN_CONGHIEN",
        "CLAN_BOSSBANG",
        "CLAN_PHUONGTHO",
        "PARTY",
		"GUESSWORD",
		"PBOX",
		"VANTIEU",
		"OANTUTI",
		"EXCHANGE"
    );

    $config["EVENT"] = array(
        "LUCKY_ROTATION",
        "RUONGTHANTAI",
        "COIN_HOARD",
        "COIN_HOARD_DAILY",
        "PBOX",
        "EXCHANGE",
        "FUNNY_ITEM",
        "GROUPON",
        "CLAN_BOSS",
		"TREE_ITEM"
    );

    $config["SERVER_STATUS"] = array(
        "OFFLINE",
        "NEW",
        "FULL",
        "MAINTAIN",
        "DEV"
    );

    $config["SEX"] = array(
        "MALE",
        "FEMALE"
    );
	
	$config["STAT_TYPE"] = array(
		"STRENGTH","DEXTERITY","VITALITY","ENERGY"
	);