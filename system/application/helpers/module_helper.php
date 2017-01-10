<?php
    function checkLogin(){
        $ci = & get_instance();
        if($ci->session->userdata("username") == false){
            $ci->session->sess_destroy();
            header('location: '.base_url());
            return;
        }
    }

    function getMenuConfig(){
        if(!file_exists(DIR_CONFIG_MENU_FILE)) return false;
        $fmenu = fopen(DIR_CONFIG_MENU_FILE,"rb");
        $contents = stream_get_contents($fmenu);
        fclose($fmenu);
        $menu = json_decode($contents);
        return $menu;
    }

    function checkPerm(){
        $ci = & get_instance();
        $i = 1;
        while($ci->uri->segment($i) !== false)
        {
            $key[] = $ci->uri->segment($i);
            $i++;
        }
        $key = implode("_",$key);

        $file_perm = DIR_CONFIG_PERMISSION_FILE.$ci->session->userdata("user_group").".json";
        if(!file_exists($file_perm)) return false;

        $fperm = fopen($file_perm,"rb");
        $content = stream_get_contents($fperm);
        fclose($fperm);
        $permission = json_decode($content);

        if($ci->session->userdata("user_group") == 0 || in_array($key, $permission->perm)) return true;
        return false;
    }

    function isAdministrator(){
        $ci = & get_instance();
        $username = $ci->session->userdata("username");
        $file_perm = DIR_CONFIG_PERMISSION_FILE.$username.".json";
        if(!file_exists($file_perm)) return false;

        $fperm = fopen($file_perm,"rb");
        $content = stream_get_contents($fperm);
        fclose($fperm);
        $permission = json_decode($content);

        return $permission->administrator;
    }

    function computeAverageRate($sizeArray = 0){
        if($sizeArray == 0) return array();
        $rateAverage = round(100 / $sizeArray);
        for($i = 0; $i < $sizeArray; $i++){
            $rate[] = $rateAverage;
        }
        $rate[0] += 100 % $sizeArray;
        return $rate;
    }

    function explodeDateRange($dateRange = false){

        if($dateRange == false){
            return array(
                'dfrom' => DateUtil::formatTime(DateUtil::beginToday(), 'm/d/Y'),
                'dto' => DateUtil::formatTime(DateUtil::endToday(), 'm/d/Y H:i:s'),
            );
        }
        $range = explode(' - ', $dateRange);
        return array(
            'dfrom' => $range[0],
            'dto' => $range[1]." 23:59:59"
        );
    }
	
	function convertGosuCoinToVND($gosu){
		switch($gosu){
			case 180:
				return 20000;
				break;
			case 450:
				return 50000;
				break;
			case 900:
				return 100000;
				break;
			case 1800:
				return 200000;
				break;
			case 4500:
				return 500000;		
				break;
		}
		return 0;
	}
	
	function styleOptionColor($optionType){
		switch($optionType){
			case "OPTION_EXTRA":
				echo 'style="color:blue"';
				break;
			case "OPTION_MAGIC":
				echo 'style="color:purple"';
				break;
			case "OPTION_UNIQUE":
				echo 'style="color:red"';
				break;
		}
	}
	
	function product_price($priceFloat) {
		$symbol = 'đ';
		$symbol_thousand = '.';
		$decimal_place = 0;
		$price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
		return $price.$symbol;
	}

    function vipSort($a, $b){
        return $a->vip == $b->vip ? 0 : ( $a->vip > $b->vip ) ? 1 : -1;
    }

    function serverSort($a, $b){
        return $a->create == $b->create ? 0 : ( $a->create > $b->create ) ? 1 : -1;
    }
	
	function mapSort($a, $b){
        return $a->level == $b->level ? 0 : ( $a->level > $b->level ) ? 1 : -1;
    }

    function achievementActionSort($a, $b){
        return $a->action == $b->action ? 0 : ( $a->action > $b->action ) ? 1 : -1;
    }

    function achievementMilestoneSort($a, $b){
        return $a->mileStone == $b->mileStone ? 0 : ( $a->mileStone > $b->mileStone ) ? 1 : -1;
    }
