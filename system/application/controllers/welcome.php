<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
		parent::__construct();
	}
	public function index()
	{
        header('Content-Type: application/json; charset=utf-8');
		$this->load->library('phpexcel/PHPExcel/IOFactory');
        $this->load->helper('excel_reader');
        $data = new Spreadsheet_Excel_Reader(DIR_STRUCT_DATA.'tuluyen.xls');
        $row_count = $data->rowcount($sheet_index=0);
        $rewardData = array();
		var_dump($data);die;
        for($i = 4; $i <= $row_count; $i++){
            $objectId = new MongoId();

            $rewardEntity = new RewardEntity();
            $rewardEntity->id = (string)$objectId;
            $rewardEntity->name = $data->val($i, 'A');
            //$rewardEntity->name = "ten";
            $rewardEntity->exp = array((int)$data->val($i, 'B'), (int)$data->val($i, 'B'));
            $rewardEntity->silver = array((int)$data->val($i, 'C'), (int)$data->val($i, 'C'));
            $rewardEntity->rateDrop = array(
                (int)$data->val($i, 'F'),
                (int)$data->val($i, 'G'),
                0,
                (int)$data->val($i, 'H'));

            $rateRank =array(0,0,0,0,0,0,0,0,0,0);
            $indexRank = (int)$data->val($i, 'D') - 1;
            $rateRank[$indexRank] = 100;
            $randomEquiment = array(
                "fixedLevel" => $data->val($i, 'E'),
                "rateQuality" => array(0,0,(int)$data->val($i, 'I'), (int)$data->val($i, 'J'), 0),
                "rateEquipment" => array(11,11,11,11,11,11,11,11,12),
                "rateRank" => (array)$rateRank
            );
            $rewardEntity->randomEquipment = (object)$randomEquiment;

            $randomUsableItem = array(
                "random" => true,
                "baseItemId" => array("55c9d8278aa21843472d75db", "55c9beb48aa21843472d714a", "5626153f3a16373f812b5d4a", "55c9bf208aa21843472d7150", "5531d7e999116004470fe609"),
                "rateDrop" => array(
                    (int)$data->val($i, 'K'),
                    (int)$data->val($i, 'M'),
                    (int)$data->val($i, 'O'),
                    (int)$data->val($i, 'Q'),
                    (int)$data->val($i, 'S')
                ),
                "quantityDrop" => array(
                    (int)$data->val($i, 'L'),
                    (int)$data->val($i, 'N'),
                    (int)$data->val($i, 'P'),
                    (int)$data->val($i, 'R'),
                    (int)$data->val($i, 'T')
                )
            );
            $rewardEntity->usableItems = (object)$randomUsableItem;

            $materialItems = array(
                "random" => true,
                "baseItemId" => array("5521439f42c7161c830ae043", "557c093beedd5f1c1cea5fe0", "55a70fad72e9761278fe8a98", "55a70fe972e9761278fe8a9a", "55b7510384b50a0b20f6381d"),
                "rateDrop" => array(
                    (int)$data->val($i, 'U'),
                    (int)$data->val($i, 'W'),
                    (int)$data->val($i, 'Y'),
                    (int)$data->val($i, 'AA'),
                    (int)$data->val($i, 'AC')
                ),
                "quantityDrop" => array(
                    (int)$data->val($i, 'V'),
                    (int)$data->val($i, 'X'),
                    (int)$data->val($i, 'Z'),
                    (int)$data->val($i, 'AB'),
                    (int)$data->val($i, 'AD')
                )
            );
            $rewardEntity->materialItems = (object)$materialItems;

            $rewardData[] = $rewardEntity;
        }
        //var_dump($rewardData);
        echo json_encode($rewardData);
	}
	
	public function excel(){
		require BASE_DIR.'/system/libraries/phpexcel/PHPExcel/IOFactory.php';
		$inputFileName = DIR_STRUCT_DATA.'tuluyen.xlsx';
		try {
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
		} catch(Exception $e) {
			die('Error loading file :' . $e->getMessage());
		}
		// All data from excel
		// $sheetData = $objPHPExcel->getActiveSheet();
		// for($x=2; $x <= 10; $x++) 
		// {
		// echo $Name = trim($sheetData[$x]['A']);
		// echo $email= trim($sheetData[$x]['B']);
		// }
	}

    public function scanDataWordQuest(){
        header('Content-Type: application/json; charset=utf-8');
//        $this->load->helper('excel_reader');
//        //if(!file_exists(DIR_STRUCT_DATA.'data_word.xls')) die("vkl");
//        chmod(DIR_STRUCT_DATA.'data_word.csv', 0777);
//        $data = new Spreadsheet_Excel_Reader(DIR_STRUCT_DATA.'data_word.csv');
//        $row_count = $data->rowcount($sheet_index=0);
        $file = fopen(DIR_STRUCT_DATA.'dhbc2.txt', "r");

        while(! feof($file))
        {
            $string = preg_split("/[\t]/", trim(fgets($file)));

            $objectId = new MongoId();
            $word = new WordQuestionEntity();

            $word->id = (string)$objectId;
            $word->answer = trim($string[0]);
            $word->viAnswer = mb_strtoupper($string[1], 'UTF-8');
            $word->imgUrl = strtolower($string[2]);

            $wordData[] = $word;
        }

        fclose($file);
        echo json_encode($wordData);
//        $wordData = array();
//
//        for($i = 1; $i <= $row_count; $i++){
//
//            $objectId = new MongoId();
//            $word = new WordQuestionEntity();
//
//            $word->id = (string)$objectId;
//            $word->answer = $data->val($i, 'A');
//            $word->viAnswer = $data->val($i, 'B');
//            $word->imgUrl = $data->val($i, 'C');
//
//            $wordData[] = $word;
//        }
//        echo json_encode($wordData);
    }
}

class RewardEntity{
    public $class = "bussiness.entity.RewardEntity";
    public $id;
    public $docType = 'REWARD';
    public $name;
    public $type = 'REWARD_MAP';
    public $exp = array(0,0);
    public $silver = array(0,0);
    public $rateDrop = array(0,0,0,0);
    public $numberItemReceive = 0;
    public $quantityDrop = 1;
    public $randomEquipment;
    public $usableItems;
    public $materialItems;
}

class WordQuestionEntity{
    public $class = "bussiness.entity.guessword.WordQuestionEntity";
    public $id;
    public $docType = "WORD_QUESTION";
    public $answer;
    public $viAnswer;
    public $imgUrl;
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */