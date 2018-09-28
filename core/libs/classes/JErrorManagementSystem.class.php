<?php
	
	class JErrorManagementSystem {
		
		private $namberError;
		
		public function __construct () {
			
		}
		
		public function setNumberError ($namberError) {
			$this->namberError = $namberError;
		}
		
		public function getMsgError () {
			$this->setNameNumberError();
		}
		
		public function lackyMsg($lackyMsg) {
			echo $lackyMsg;
		}
		
		private function setNameNumberError () {
			switch ($this->namberError) {
				case "0001xL":
				echo "Короткий логин! Проверьте введеную информацию!";
				break;
				
				case "0001xP":
				echo "Короткий пароль! Проверьте введеную информацию!";
				break;
				
				case "0002xP":
				echo "Неверный пароль!";
				break;
				
				case "0003xP":
				echo "Пароли не совпадают!";
				break;
				
				case "0001xU":
				echo "Пользователь с таким логином не найден!";
				break;
				
				case "0002xU":
				echo "Пользователь с таким логином зарегестрирован!";
				break;
				
				case "0001xM":
				echo "Неверный формат E-Mail!";
				break;
				
				case "UNKNOWN":
				echo "FATAL_ERROR:Возникла неизвестная ошибка";
				break;
			}
		}
	}