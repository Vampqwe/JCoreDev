<?php
	
	class JNews {
		
		private $dataNews;
		private $DB_news;
		
		public function __construct () {
			$this->DB_news = new JDb();
		}
		
		public function setNews ($dataNews = []) {
			$this->dataNews = $dataNews;
		}
		
		public function getAllNews () {
			$sql = "SELECT `titleNews`, 
				`contentNews`, 
				`imgNews`, 
				`lincNews`, 
				`categoryNews`
				FROM `news`";
			return $this->DB_news->fetchArr($sql);
		}
		
		public function getNews () {
			$sql = "SELECT `titleNews`, 
				`contentNews`, 
				`imgNews`, 
				`lincNews`, 
				`categoryNews`
				FROM `news` WHERE `titleNews` = '".$this->dataNews['titleNews']."'";
			return $this->DB_news->fetch($sql);
		}
		
		
		
		
		
		
	}