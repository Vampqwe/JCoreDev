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
				echo "�������� �����! ��������� �������� ����������!";
				break;
				
				case "0001xP":
				echo "�������� ������! ��������� �������� ����������!";
				break;
				
				case "0002xP":
				echo "�������� ������!";
				break;
				
				case "0003xP":
				echo "������ �� ���������!";
				break;
				
				case "0001xU":
				echo "������������ � ����� ������� �� ������!";
				break;
				
				case "0002xU":
				echo "������������ � ����� ������� ���������������!";
				break;
				
				case "0001xM":
				echo "�������� ������ E-Mail!";
				break;
				
				case "UNKNOWN":
				echo "FATAL_ERROR:�������� ����������� ������";
				break;
			}
		}
	}