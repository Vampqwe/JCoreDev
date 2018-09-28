<?php
	class JDb {
		
		private $dbConnect;
		
		public function __construct () {
			$this->connectDb();
		}
		
		private function connectDb () {
			try{
				$this->dbConnect = new PDO("mysql:host=".JCONFIG['db_Host'].
						";dbname=".JCONFIG['db_Name'].
						";charset=".JCONFIG['db_CharSet'],
						JCONFIG['db_Login'],
						JCONFIG['db_Password'],
						[PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        				PDO::ATTR_EMULATE_PREPARES   => false]);
        		return $this->dbConnect;
			}catch(PDOException $exc) {
				echo '!DB_ERROR[error_connect]!'.$exc->getMessage();
			}
		}
		
		public function dbExec ($sql) {
			try{
				$prep = $this->dbConnect->prepare($sql);
				return $prep->execute();
			}catch(PDOException $exc) {
				echo '!DB_ERROR[dbexec]!'.$exc->getMessage();
			}	
		}
		
		public function fetch ($sql) {
			try {
				$prep = $this->dbConnect->prepare($sql);
				$prep->execute();
				$rslt = $prep->fetch();
				return $rslt;
			}catch(PDOException $exc) {
				echo '!DB_ERROR[fetch]!'.$exc->getMessage();
			}
		}
		
		public function fetchRow ($sql) {
			try {
				$prep = $this->dbConnect->prepare($sql);
				$prep->execute();
				$rslt = $prep->rowCount();
				return $rslt;
			}catch(PDOException $exc) {
				echo '!DB_ERROR[fetchRow]!'.$exc->getMessage();
			}
		}
		
		public function fetchArr ($sql) {
			try {
				$prep = $this->dbConnect->prepare($sql);
				$prep->execute();
				$rslt = $prep->fetchAll();
				return $rslt;
			}catch(PDOException $exc) {
				echo '!DB_ERROR[fetch_arr]!'.$exc->getMessage();
			}
		}
	}
?>