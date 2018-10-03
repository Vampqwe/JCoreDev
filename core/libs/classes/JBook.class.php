<?php
	
	class JBook {
		
		private $DB_Jb;
		private $dataBook = [];
		
		public function __construct () {
			$this->DB_Jb = new JDb();
		}
		
		public function setDataBook ($dataBook) {
			$this->dataBook = $dataBook;
		}
		
		public function getAllBooks () {
			$sql = "SELECT * FROM `book`";
			return $this->DB_Jb->fetchArr($sql);
		}
		
		public function getOneBook () {
			$sql = "SELECT * FROM `book` WHERE `titleBook` = '".$this->dataBook['titleBook']."'";
			return $this->DB_Jb->fetch($sql);
		}
	}