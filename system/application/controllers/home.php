<?php

class Home extends CI_Controller
{

    private $datas;
    private $api;

    function __construct()
    {
        parent::__construct();
        $this->api = $this->config->item("api");
    }

    function index()
    {
        if ($this->session->userdata("username") !== false) {
            redirect(base_url() . "drashboard");
        } else {
            $this->datas["data"] = array();
            $this->load->view("login", $this->datas);
        }
    }

    public function login()
    {
        $validate = $this->checkRequestLogin();
        if ($validate !== true) die($validate);

        $admin = $this->getAdminInfo($_POST["username"], $_POST["password"]);
        if ($admin == null) die("Tài khoản không đúng!");
        if ($admin->group != 0 && $_POST["server_remote"] == "dev") die("Bạn không có quyền truy cập vào server dev");

        $this->session->set_userdata("username", $admin->username);
        $this->session->set_userdata("user_group", $admin->group);
        $this->session->set_userdata("server_remote", $_POST["server_remote"]);
        die("success");
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    public function permission()
    {
        $this->datas["sub"] = "permission";
        $this->datas["menu"] = getMenuConfig();
        $this->datas["active_menu"] = "drashboard";
        $this->datas["data"] = array();
        $this->load->view(TEMPLATE, $this->datas);
    }

    private function checkRequestLogin()
    {
        if (!isset($_POST["username"]) || !isset($_POST["password"]) || !isset($_POST["server_remote"])) return "Invalid request";
        if (!preg_match("/^[a-zA-Z0-9_]{5,32}+$/", $_POST["username"])) return "Tên đăng nhập chứa 5 -> 32 ký tự a-z A-Z 0-9 _";
        if (!preg_match("/^[a-zA-Z0-9_]{5,32}+$/", $_POST["password"])) return "Mật khẩu chứa 5 -> 32 ký tự a-z A-Z 0-9 _";
        $sv = array("dev", "vl", "en", "cn");
        if (!in_array($_POST["server_remote"], $sv)) return "Don't hack me";
        return true;
    }

    private function getAdminInfo($username, $password)
    {
        $file_user = DIR_CONFIG_PERMISSION_FILE . "user.json";
        $fh = fopen($file_user, "rb");
        $content = stream_get_contents($fh);
        fclose($fh);
        $listUser = json_decode($content);
        foreach ($listUser as $user) {
            if ($user->username == $username && $user->password == md5(md5($password))) return $user;
        }
        return null;
    }
	
	private function createBaseRequest(){
            $request = array(
                "data" => "",
                "sandbox" => false,
                "token" => "token"
            );

            return $request;
	}
	
	public function topLevelAndMetaPower(){
		// die;
		header('Content-Type: text/html; charset=utf-8');
		$this->session->set_userdata("server_remote", "vl");
		$this->load->model("playerdao");
		$topLevel = $this->playerdao->findTopLevel("S31");
		$topMetaPower = $this->playerdao->findTopMetaPower("S31");
		
		$str1 = "";
		$str11 = "";
		$str2 = "";
		$str22 = "";
		
		$i = 1;
		foreach($topLevel as $top1){
			//echo json_encode($top1->name);
			$str1 .= "$i. $top1->code -- $top1->name -- $top1->level <br/>";
			$str11 .= "$i. $top1->code -- $top1->name -- $top1->level \r\n";
			$i += 1;
		}
		
		$j=1;
		foreach($topMetaPower as $top2){
			$str2 .= "$j. $top2->code -- $top2->name -- $top2->metaPower <br/>";
			$str22 .= "$j. $top2->code -- $top2->name -- $top2->metaPower \r\n";
			$j += 1;
		}
		
		echo "Top level S31: <br/>";
		echo $str1."<br/>";
		echo "Top chien luc S31: <br/>";
		echo $str2;
		
		$file1 = fopen(DIR_STRUCT_DATA."top_level_s30.log","w");
		
		fwrite($file1,$str11);
		fclose($file1);
		
		$file2 = fopen(DIR_STRUCT_DATA."top_power_s30.log","w");
		
		fwrite($file2,$str22);
		fclose($file2);
	}
	
	public function topHS(){
		// die;
		header('Content-Type: text/html; charset=utf-8');
		$this->session->set_userdata("server_remote", "vl");
		$this->load->model("playerdao");
		$data = $this->playerdao->findTopHoason("S30");
		
		$str1 = "";
		$str11 = "";
		
		$i = 1;
		foreach($data as $top1){
			//echo json_encode($top1->name);
			$str1 .= "$i. $top1->code -- $top1->name<br/>";
			$str11 .= "$i. $top1->code -- $top1->name -- $top1->rank \r\n";
			$i += 1;
		}
		
		echo $str1;
		
		$file = fopen(DIR_STRUCT_DATA."top_hs_s30.log","w");
		
		fwrite($file,$str11);
		fclose($file);
		
	}
}