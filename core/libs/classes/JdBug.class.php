<?php
/**
* 
* Class
* 
* @return
*/
	final class JdBug {
		
		private $inputVar;
		private $inputType;
		private $param;
		private static $timerStart;
		
		public function __construct ($var = "",$onOff = 0,$param = FALSE) {
			if ($onOff == 0) {
				return FALSE;
			}elseif ($onOff == 1) {
				$this->inputVar = $var;
				$this->inputType = gettype($var);
				$this->param = $param;
				$this->menu();
			}elseif ($onOff > 1) {
				$this->IfGarbage();
			}
		}
		/**
		* 
		* Utils
		* 
		* @return
		*/
		public static function dmp ($var = FALSE) {
			if (!$var) {
				return FALSE;
			}else{
				echo "!---___:Start DMP:__________------->"."<br>";
				echo "<pre>".var_dump($var)."</pre>";
				echo "!-:Stop dmp--->"."<br>";
			}
		}
		//
		public static function timerStart() {	
			return self::$timerStart = microtime(true);
		}
		
		public static function timerStop () {
			$time = microtime(true) - self::timerStart();
			printf('Скрипт выполнялся %.4F сек.', $time);
		}

		public function getJdBugInfo () {
			return $this->dmp($this);
		}
		/**
		* 
		* Core
		* 
		* @return
		*/
		private function menu () {
			switch ($this->inputType) {
				case 'integer':
				$this->ifInt();
				break;
				
				case 'string':
				$this->ifStr();
				break;
				
				case 'object':
				$this->ifObj();
				break;
				
				case 'boolean':
				$this->ifBool();
				break;
				
				
				case 'double':
				break;
				
				case 'NULL':
				$this->ifNull();
				break;
				
				case 'array':
				$this->ifArr();
				break;
			}
		}
		
		private function ifBool () {
			echo "!---___:Start JdBug:__________------->"."<br>";
			echo "Type var =>[".$this->inputType."]"."<br>";
			echo "Value =>[".$this->inputVar."]"."<br>";
			echo "Value length =>[".mb_strlen($this->inputVar)."]"."<br>";
			echo "!----------___Stop___-------------!"."<br>";
		}
		
		private function ifInt () {
			echo "!---___:Start JdBug:__________------->"."<br>";
			echo "Type var =>[".$this->inputType."]"."<br>";
			echo "Value =>[".$this->inputVar."]"."<br>";
			echo "Value length =>[".mb_strlen($this->inputVar)."]"."<br>";
			echo "!----------___Stop___-------------!"."<br>";
		}
		
		private function ifArr () {
			echo "!---___:Start JdBug:__________------->"."<br>";
			echo "Type var =>[".$this->inputVar."]"."<br>";
			echo "Value length =>[".count($this->inputVar, COUNT_RECURSIVE)."]"."<br>";
			echo "<ul>";
			foreach ($this->inputVar as $key => $val) {
				echo "<li>[".$this->inputVar[$key]=$key."] =>".$this->inputVar[$key]=$val."</li>";
			}
			echo "</ul>";
			echo "!----------___Stop___-------------!"."<br>";
		}
		
		private function ifStr () {
			echo "!---___:Start JdBug:__________------->"."<br>";
			echo "Type var =>[".$this->inputType."]"."<br>";
			echo "Value length =>[".strlen($this->inputVar)."]"."<br>";
			echo "<ul>";
			echo "<li>[".$this->inputVar."]</li>";
			echo "</ul>";
			echo "!----------___Stop___-------------!"."<br>";
		}
		
		private function ifObj () {
			if (!$this->param) {
				echo "!---___:Start Min JdBug:__________------->"."<br>";
				echo "Type var =>[".$this->inputType."]"."<br>";
				echo "Class name =>[".$gc = get_class($this->inputVar)."]"."<br>";
				echo "<ul>";
				echo "<li>[".get_class_vars($gc)."]</li>";
				echo "</ul>"."<br>";
				echo "!----------___Stop___-------------!"."<br>";
			}else{
				echo "!---___:Start Max JdBug:__________------->"."<br>";
				echo "Type var =>[".$this->inputType."]"."<br>";
				echo "Class name =>[".get_class($this->inputVar)."]"."<br>";
				echo "<ul>";
				echo "Loaded Classes=>";
				echo "<li>";
				print_r(get_declared_classes());
				echo "</li>";
				echo "</ul>";
				echo "!----------___Stop___-------------!"."<br>";
			}
			
		}
		
		private function ifNull () {
			echo "!---___:Start Max JdBug:__________------->"."<br>";
			echo "Type var =>[".$this->inputType."]"."<br>";
			echo "Value length =>[".strlen($this->inputVar)."]"."<br>";
			echo "<ul>";
			echo "<li>[".$this->inputVar."]</li>";
			echo "</ul>";
			echo "!----------___Stop___-------------!"."<br>";
		}
		
		protected function IfGarbage () {
			echo "Why are you pampering, you bastard! ;););)";
		}
		
		final function __destruct () {
			unset($this->inputVar, $this->inputType);
		}
		
		
	}