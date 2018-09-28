<?php
/**
* class JUserManagementSystem()
*/
	class JUserManagementSystem {
		
		private $userData = ["userLogin" => "",
							"userMail" => "",
							"userCoin" => "",
							"userPass" => "",
							"userPassRep" => "",
							"userAcces" => ""];
		private $UMS_db;
		
		public function __construct ($usd = []) {
			$this->userData = $usd;
			$this->UMS_db = new JDb();
		}
		
		public function setUserData ($userData = []) {
			foreach ($userData as $key => $val) {
				$this->userData[$key]=$val;
			}
		}
		
		public function userExist () {
			$sql = "SELECT `id` 
			FROM `user` 
			WHERE `userLogin` = '".$this->userData['userLogin']."'";
			$query = $this->UMS_db->fetchRow($sql);
			if ($query == 0) {
				return FALSE;
			}
			return TRUE;
		}
		
		public function passHash () {
			$this->userData['userPass'] = password_hash($this->userData['userPass'], PASSWORD_DEFAULT);
			return $this->userData['userPass'];
		}
		
		public function verifyPass () {
			$sql = "SELECT `userPass` 
			FROM `user` 
			WHERE `userLogin` = '".$this->userData['userLogin']."'";
			$query = $this->UMS_db->fetch($sql);
			return password_verify($this->userData['userPass'], $query['userPass']);
		}
		
		public function passCompare () {
			if ($this->userData['userPass'] != $this->userData['userPassRep']) {
				return FALSE;
			}else{
				return TRUE;
			}
		}
		
		public function addUserDb () {
			$sql = "INSERT INTO `user` (`userLogin`,
									`userRank`,
									`userCoin`,
									`userMail`,
									`userIp`,
									`userDateReg`,
									`userAcces`,
									`userPass`)
					VALUES ('".$this->userData['userLogin']."',
						'".JCONFIG['new_User_Rank']."',
						'".JCONFIG['default_User_Coin']."',
						'".$this->userData['userMail']."',
						'".JCore::getUserIp()."',
						'".JCore::getDate()."',
						'".JCONFIG['new_User_Acces']."',
						'".$this->userData['userPass']."')";
			$query = $this->UMS_db->dbExec($sql);
		}
		
		public function getOneUserDb () {
			$sql = "SELECT `id`, 
				`userLogin`,
				`userRank`, 
				`userCoin`, 
				`userMail`, 
				`userIp`,
				`userDateReg`,
				`userAcces` 
			FROM `user` WHERE `userLogin` = '".$this->userData['userLogin']."'";
			$query = $this->UMS_db->fetch($sql);
			return $query;
		}
		
		public function getAllUsersDb () {
			$sql = "SELECT `id`, `userLogin`, `userRank`, `userMail`, `userCoin`, `userAcces` 
				FROM `user`";
			$query = $this->UMS_db->fetchArr($sql);
			return $query;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	