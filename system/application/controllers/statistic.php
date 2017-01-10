<?php

class Statistic extends BaseController
{

    private $startTime = '04/01/2016';
    //private $startTimeRev = '03/09/2016';

    function __construct()
    {
        parent::__construct();
        $this->datas["active_menu"] = __CLASS__;
    }

    public function nru()
    {
        $this->load->model("user_dao");
        $datas = $this->user_dao->nru();
        $chartData = array();
        foreach($datas['result'] as $result){
            $chartData[] = array(strtotime($result['_id']['year'].'-'.$result['_id']['month'].'-'.$result['_id']['day']) * 1000 + MILISECOND_GMT7, $result['count']);
        }
        $this->isAllowAccess();
        $this->datas["sub"] = "statistic/stockchart";
        $this->datas["title"] = "Đăng ký hàng ngày";
        $this->datas["data"] = array("chartData" => json_encode($chartData));
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function dau(){

        // $startTime = strtotime($this->startTime) * 1000 + MILISECOND_GMT7;
        $endTime = DateUtil::beginToday() * 1000 + MILISECOND_GMT7;
		$startTime = $endTime - 86400 * 30 * 1000;

        $viewData = $this->computeDAU($startTime, $endTime);

        $this->isAllowAccess();
        $this->datas["sub"] = "statistic/stockchart";
        $this->datas["title"] = "Đăng nhập hàng ngày";
        $this->datas["data"] = array("chartData" => json_encode($viewData));
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function ccu(){

        $dateRange = isset($_POST['range']) ? explodeDateRange($_POST['range']) : explodeDateRange();

        $dfrom = strtotime($dateRange['dfrom']);
        $dto = strtotime($dateRange['dto']);

        $from = new MongoDate($dfrom);
        $to = new MongoDate($dto);

        $this->load->model("log_ccu_dao");
        $datas = $this->log_ccu_dao->ccu($from, $to);
        $chartData = array();
        foreach($datas['result'] as $result){
            $chartData[] = array(strtotime($result['_id']['year'].'-'.$result['_id']['month'].'-'.$result['_id']['day'].' '.$result['_id']['hour'].':'.$result['_id']['minute'].":00") * 1000 + MILISECOND_GMT7, $result['count']);
        }

        $this->isAllowAccess();
        $this->datas["sub"] = "statistic/ccu";
        $this->datas["title"] = "CCU";
        $this->datas["data"] = array(
            "chartData" => json_encode($chartData),
            "range"     => DateUtil::formatTime($dfrom, 'm/d/Y').' - '.DateUtil::formatTime($dto, 'm/d/Y'),
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function niu(){
        $this->isAllowAccess();
        $this->datas["sub"] = "statistic/niu";
        $this->datas["title"] = "NIU";
        $this->datas["data"] = array();
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function getNiuData(){
        $key = $this->uri->segment(3);
        $startTime = strtotime($this->startTime) * 1000 + MILISECOND_GMT7;
        $endTime = DateUtil::beginToday() * 1000 + MILISECOND_GMT7;

        $this->load->model("log_niu_dao");
        $datas = $this->log_niu_dao->niu($key);

        foreach($datas['result'] as $result){
            $dataChart[''.(strtotime($result['_id']['year'].'-'.$result['_id']['month'].'-'.$result['_id']['day']) * 1000 + MILISECOND_GMT7)] = $result['count'];
        }

        while($startTime <= $endTime){
            $viewData[] = isset($dataChart[''.$startTime]) ? array($startTime, $dataChart[''.$startTime]) : array($startTime, 0);
            $startTime += 86400000;
        }

        echo json_encode($viewData);
    }

    public function rev(){

        // $startTime = strtotime($this->startTime) * 1000 + MILISECOND_GMT7;
        $endTime = DateUtil::beginToday() * 1000 + MILISECOND_GMT7;
		$startTime = $endTime - 86400 * 30 * 1000;
		$gateway = $this->uri->segment(3) ? $this->uri->segment(3) : "GOSU";

        $viewData = $this->computeREV($gateway, $startTime, $endTime);

        $this->isAllowAccess();
        $this->datas["sub"] = "statistic/log_trans";
        $this->datas["title"] = "Doanh thu hàng ngày";
        $this->datas["filed_name"] = "rev";
        $this->datas["data"] = array("chartData" => json_encode($viewData), "gateway" => $gateway);
        $this->load->view(TEMPLATE, $this->datas);
    }

    /**
     * Paid User
     */
    public function pu(){

        // $startTime = strtotime($this->startTime) * 1000 + MILISECOND_GMT7;
        $endTime = DateUtil::beginToday() * 1000 + MILISECOND_GMT7;
		$startTime = $endTime - 86400 * 30 * 1000;

        $viewData = $this->computePU($startTime, $endTime);

        $this->isAllowAccess();
        $this->datas["sub"] = "statistic/stock_column";
        $this->datas["title"] = "Paid User";
        $this->datas["data"] = array("chartData" => json_encode($viewData));
        $this->load->view(TEMPLATE, $this->datas);
    }

    /**
     * Retention Rate
     */
    public function rr(){

        // $startTime = strtotime($this->startTime) * 1000 + MILISECOND_GMT7;
        $endTime = DateUtil::beginToday() * 1000 + MILISECOND_GMT7;
		$startTime = $endTime - 86400 * 30 * 1000;

        $dau = $this->computeDAU($startTime, $endTime);
        for($i = 1; $i < count($dau); $i++){
            $chartData[] = $dau[$i - 1][1] > 0 ? array($dau[$i][0], min(round($dau[$i][1] / $dau[$i - 1][1], 2) * 100, 100)) : array($dau[$i][0], min($dau[$i][1] * 100, 100));
        }

        $this->isAllowAccess();
        $this->datas["sub"] = "statistic/stock_column";
        $this->datas["title"] = "Retention Rate";
        $this->datas["data"] = array(
            "chartData" => json_encode($chartData),
            "filed_name" => "rr"
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    public function testRR(){
        $date = isset($_POST["date"]) ? str_replace("/","-",$_POST["date"]) : DateUtil::formatTime(DateUtil::getCurrentUnix() - 86400, 'd-m-Y');
        $range = isset($_POST["range"]) ? intval($_POST["range"]) : 1;

        $time = DateUtil::stringTimeAsiaToUnix($date);
        $rangeTime = 86400 * $range;
        $from = new MongoDate($time - $rangeTime);
        $to = new MongoDate($time + 86400 - $rangeTime);

        $nfrom = new MongoDate($time);
        $nto = new MongoDate($time + 86400);

        $this->load->model("user_dao");
        $this->load->model("log_login_dao");

        $preNRU = $this->user_dao->nruByDate2($from, $to);
        $usernameList = array();
        foreach($preNRU as $nru){
            $usernameList[] = $nru->username;
        }
        
		$dau = $this->log_login_dao->dauByDay($nfrom, $nto);
        $oldDAU = $this->log_login_dao->dauOldUser($nfrom, $nto, $usernameList);

        $rr = min(round(($oldDAU["result"][0]["count"] / $dau["result"][0]["count"]) * 100, 2), 100);

        $chartData = array((object)array("name" => "Retention Rate", "y" => $rr), (object)array("name" => "out", "y" => 100 - $rr));

        $this->datas["sub"] = "statistic/piechart";
        $this->datas["title"] = "Retention Rate";
        $this->datas["data"] = array(
            "chartData" => json_encode($chartData),
            "date" => $date,
            "range" => $range
			
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    /**
     * Average Revenue per Users
     * Rev/DAU
     */
    public function arpu(){
		
        $endTime = DateUtil::beginToday() * 1000 + MILISECOND_GMT7;
		$startTime = $endTime - 86400 * 30 * 1000;

        $rev = $this->computeREV("GOSU",$startTime, $endTime);
        $dau = $this->computeDAU($startTime, $endTime);
		// echo json_encode($dau);die;

        for($i = 0; $i < count($rev); $i++){
           $chartData[] = $dau[$i][1] <= 0 ? array($rev[$i][0], 0) : array($rev[$i][0], $rev[$i][1] / $dau[$i][1]);
        }

        $this->isAllowAccess();
        $this->datas["sub"] = "statistic/stock_column";
        $this->datas["title"] = "Average Revenue per Users";
        $this->datas["data"] = array(
            "chartData" => json_encode($chartData),
            "filed_name" => "arpu"
        );
        $this->load->view(TEMPLATE, $this->datas);
    }

    /**
     * Average Revenue per Paying User
     * Rev/PU
     */
    public function arppu(){

        // $startTime = strtotime($this->startTime) * 1000 + MILISECOND_GMT7;
        $endTime = DateUtil::beginToday() * 1000 + MILISECOND_GMT7;
		$startTime = $endTime - 86400 * 30 * 1000;

        $rev = $this->computeREV("GOSU",$startTime, $endTime);
        $pu = $this->computePU($startTime, $endTime);

        for($i = 0; $i < count($rev); $i++){
            $chartData[] = $pu[$i][1] <= 0 ? array($rev[$i][0], 0) : array($rev[$i][0], $rev[$i][1] / $pu[$i][1], 2);
        }

        $this->isAllowAccess();
        $this->datas["sub"] = "statistic/stock_column";
        $this->datas["title"] = "Average Revenue per Paying User";
        $this->datas["data"] = array(
            "chartData" => json_encode($chartData),
            "filed_name" => "arppu"
        );
        $this->load->view(TEMPLATE, $this->datas);
    }
	
	public function logTrans(){
		
		$dateRange = isset($_POST['range']) ? explodeDateRange($_POST['range']) : explodeDateRange();
		// echo json_encode($dateRange);

        $dfrom = strtotime($dateRange['dfrom']);
        $dto = strtotime($dateRange['dto']);

        $from = new MongoDate($dfrom);
        $to = new MongoDate($dto);

        $this->load->model("log_transaction_dao");
        $logs = $this->log_transaction_dao->listTranInRange($from, $to);
		
		$this->datas["sub"] = "statistic/log_transaction";
        $this->datas["title"] = "Doanh thu hàng ngày";
        $this->datas["data"] = array(
            "logs" => $logs,
            "range"     => DateUtil::formatTime($dfrom, 'm/d/Y').' - '.DateUtil::formatTime($dto, 'm/d/Y'),
        );
        $this->load->view(TEMPLATE, $this->datas);
	}
	
	public function logUSDTrans(){
		
		$dateRange = isset($_POST['range']) ? explodeDateRange($_POST['range']) : explodeDateRange();
		// echo json_encode($dateRange);

        $dfrom = strtotime($dateRange['dfrom']);
        $dto = strtotime($dateRange['dto']);

        $from = new MongoDate($dfrom);
        $to = new MongoDate($dto);

        $this->load->model("log_transaction_dao");
        $logs = $this->log_transaction_dao->listTranUSDInRange($from, $to);
		
		$this->datas["sub"] = "statistic/log_usd";
        $this->datas["title"] = "Doanh Apple thu hàng ngày";
        $this->datas["data"] = array(
            "logs" => $logs,
            "range"     => DateUtil::formatTime($dfrom, 'm/d/Y').' - '.DateUtil::formatTime($dto, 'm/d/Y'),
        );
        $this->load->view(TEMPLATE, $this->datas);
	}

    private function computeDAU($startTime, $endTime){

        $this->load->model("log_login_dao");
        $datas = $this->log_login_dao->dau();

        foreach($datas['result'] as $result){
            $dataChart[''.(strtotime($result['_id']['year'].'-'.$result['_id']['month'].'-'.$result['_id']['day']) * 1000 + MILISECOND_GMT7)] = $result['count'];
        }

        while($startTime <= $endTime){
            $viewData[] = isset($dataChart[''.$startTime]) ? array($startTime, $dataChart[''.$startTime]) : array($startTime, 0);
            $startTime += 86400000;
        }

        return $viewData;
    }

    private function computePU($startTime, $endTime){

        $this->load->model("log_transaction_dao");
        $datas = $this->log_transaction_dao->pu();
        foreach($datas['result'] as $result){
            $dataChart[''.(strtotime($result['_id']['year'].'-'.$result['_id']['month'].'-'.$result['_id']['day']) * 1000 + MILISECOND_GMT7)] = $result['count'];
        }

        while($startTime <= $endTime){
            $viewData[] = isset($dataChart[''.$startTime]) ? array($startTime, $dataChart[''.$startTime]) : array($startTime, 0);
            $startTime += 86400000;
        }

        return $viewData;
    }

    private function computeREV($gateway, $startTime, $endTime){

        $this->load->model("log_transaction_dao");
        $datas = $this->log_transaction_dao->rev($gateway);

        foreach($datas['result'] as $result){
            $dataChart[''.(strtotime($result['_id']['year'].'-'.$result['_id']['month'].'-'.$result['_id']['day']) * 1000 + MILISECOND_GMT7)] = $result['count']*20000*9/1800;
        }

        while($startTime <= $endTime){
            $viewData[] = isset($dataChart[''.$startTime]) ? array($startTime, $dataChart[''.$startTime]) : array($startTime, 0);
            $startTime += 86400000;
        }

        return $viewData;
    }
}