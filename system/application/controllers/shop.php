<?php

class shop extends BaseController{

    function __construct()
    {
        parent::__construct();
        $this->datas["active_menu"] = 'StaticData';
    }

    public function index(){
        $this->isAllowAccess();
        $config_shop = $this->request(array("doc_type" => "SHOP_CONFIG"), $this->api["gmtool_get_base"]);

        $materials = $this->request(array("doc_type" => "MATERIAL"), $this->api["gmtool_get_base"]);
        $usableItems = $this->request(array("doc_type" => "USABLE_ITEM"), $this->api["gmtool_get_base"]);

        $items = array();
        $items = array_merge($items, $materials->cache_data);
        $items = array_merge($items, $usableItems->cache_data);

        //$simpleData = array();
        foreach($items as $item){
            $simpleData[$item->id]["name"] = $item->name;
            $simpleData[$item->id]["doc_type"] = $item->docType;
        }
        $data = array(
            "shop_config" => $config_shop,
            "items" => $simpleData,
            "title" => "Cấu hình shop"
        );
        $this->datas["sub"] = "static_data/shop_config";
        $this->datas["data"] = $data;
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function saveShopConfig(){
		
        $file = DIR_STRUCT_DATA."shop_server.json";
		$file = fopen(DIR_STRUCT_DATA."shop_server.json","rb");
        $content = stream_get_contents($file);
        fclose($file);
        $data = json_decode($content);
		$this->request((object)array("products" => $data), $this->api["gmtool_shopserver_save"]);
    }
}