<?php

	class Session{
		
		private $name;
		private $value;
		
		public function __construct($name=null, $value=null){
			
			$this->name=$name;
			$this->value=$value;
		}
		
		# creer une session initiale
		public function setSession(){
			
			$_SESSION[$this->name]=$this->value;
		}
		
		#creer unnouveau element de session
		public function setSessionItem($name, $value){
				
			$_SESSION[$name]=$value;
		}
		
		#r�cup�ration d'un �lement de session
		public function getSession($name){
			return $_SESSION[$name];
		}
		
		public function sessionDestruct(){
			#vider la variable session  par s�curit�
			session_unset();
			#detruire la variable session
			session_destroy();
		}
		
		#fin class Session
	}


?>