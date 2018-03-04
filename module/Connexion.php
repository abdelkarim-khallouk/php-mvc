<?php
#class connexion permet de fournir le service PDO = php data object
	class Connexion{
		
		#paramètre de connexion
		
		private $host="localhost";
		private $user="root";
		private $pwd="";
		private $dbname="zend_db";
		private $pdo; //déffinion de la variable
		
		public function __construct(){
			
		}
		
		#creation de service getPdo();
		
		public function getPdo(){
			#PDO("mysql:host='localhost';dbname='lanouvelledb','root',''");
			try{
				
			$this->pdo=new PDO("mysql:host={$this->host};dbname=".$this->dbname,$this->user,$this->pwd);
			return $this->pdo;
			
			}catch(Exception $e){
				
				echo("Erreur: ".$e->getMessage());
				
			}
			
		}
		
	}
/*	
	$pdo=new Connexion();
	$statement=$pdo->getPdo();
	*/

?>