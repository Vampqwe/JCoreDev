<?php
/**
* Class JCore
*/
	class JCore {
		
		private $pathToConfig = "config.ini";
		private $config;
		private $switchJCore = TRUE;
		
		public function __construct () {
			if (!$this->switchJCore) {
				$this->siteIsOff();
			}else{
				$this->startConfig();
				$this->autoLoadClass();
				$this->startSession();
			}
		}
		
		private function startConfig () {
			if(!$this->config = parse_ini_file($this->pathToConfig)) {
				return FALSE;
			}
			return define('JCONFIG', $this->config);
		}
		
		private function autoLoadClass () {
			$splALoadClass = spl_autoload_register (
				function ($class) {
    			require_once JCONFIG['corLibClass'].$class.'.class.php';
    			}
			);
		}
		
		private function startSession () {
			session_start();
			if (empty($_SESSION)) {
				$_SESSION['userLogin'] = JCONFIG['default_User_Name'];
				$_SESSION['userAcces'] = JCONFIG['default_User_Acces'];
			}
		}
		
		public static function getSession () {
			return $_SESSION;
		}
		
		public static function getSessAccesUser () {
			return $_SESSION['userAcces'];
		}
		
		public static function setSession ($dataSession = []) {
			foreach ($dataSession as $key => $val) {
				$_SESSION[$key] = $val;
			}
		}
		
		public static function AccesName ($acces) {
			switch ($acces) {
				case '0';
				return "Прохожий";
				break;
				
				case '1';
				return 'Гость';
				break;
				
				case '2';
				return 'Модератор';
				break;
				
				case '3';
				return 'Администратор';
				break;
			}
		}
		
		public static function userRank ($rank) {
			switch ($rank) {
				case '0';
				return "Дезертир";
				break;
				
				case '1';
				return 'Рядовой';
				break;
				
				case '2';
				return 'Сержант';
				break;
				
				case '3';
				return 'Лейтенант';
				break;
				
				case '4';
				return 'Майор';
				break;
				
				case '5';
				return 'Полковник';
				break;
			}
		}
		
		public static function stopSession () {
			session_destroy();
		}
		
		public static function configInfo () {
			$congigInfo = new JdBug(JCONFIG,1);
			return $congigInfo;
		}
		
		public static function jSystemObj () {
			return new JCore();
		}
		
		private function siteIsOff () {
			echo "...Сайт выключен!...";
			echo "Как включить сайт?";
			echo "<br>Измените значение переменной *switchJCore = FALSE* на *switchJCore = TRUE*".
			"<br>В файле: *".__FILE__."* В классе:*".__CLASS__."*";
		}
		public static function getDate() {
			return date("Y-m-d");
		}
		
		public static function getUserIp () {
			return filter_input(INPUT_SERVER,"REMOTE_ADDR",FILTER_VALIDATE_IP);
		}
		
		public static function postInput($postKey) {
			return filter_input(INPUT_POST, $postKey);
		}
		public static function getInput($getKey) {
			return filter_input(INPUT_GET, $getKey);
		}
		public static function arrPostInput($postArr) {
			return filter_input_array(INPUT_POST, $postArr);
		}
		public static function arrGetInput($getArr) {
			return filter_input_array(INPUT_GET, $getArr);
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	