<?php

	require_once (ROOT."module/Connexion.php");

#cette class permet de fournir les méthodes de CRUD pour la table utilsateur
	
	class UtilisateurModel extends Connexion{
		
		#définition de la structure de la table
		
		private $table="utilisateur";
		private $idUtilisateur;
		private $emailUtilisateur;
		private $pwdUtilisateur;
		private $nomUtilisateur;
		
		#définition des noms de colonnes
		
		private $idCol="id_utilisateur";
		private $emailCol="email_utilisateur";
		private $pwdCol="pwd_utilisateur";
		private $nomCol="nom_utilisateur";
		
		public function __construct($email=NULL,$pwd=NULL,$nom=NULL){
			
			#$this->idUtilisateur=$id;
			$this->emailUtilisateur=$email;
			$this->pwdUtilisateur= $pwd;
			$this->nomUtilisateur=$nom;
			
		}
		
		#METHODES DE VERIFICATION
		private function checkValue($c,$v){ #$c=colonne, $v=valeur
			$statement ="SELECT * FROM {$this->table} WHERE $c='$v'";
			#echo $statement;
			$queryresult= $this->getPdo()->query($statement);
			#echo $queryresult->fetchColumn()."</br>";
			if($queryresult->fetchColumn() > 0)
			{
				
				return true;
			}
			else{
				return false;
				
			}
			
		}
		
		#CREATION DU CRUD
		
		#CREATE & UPDATE
		
		public function saveOrUpdate($id=NULL){ 
			if($this->checkValue($this->emailCol, $this->emailUtilisateur)== false)
			{
			#SAVE
			if($id == null ){
				
				#statement veut dire requete SQL
				$statement ="INSERT INTO {$this->table} VALUES ('',
								'$this->emailUtilisateur',
								'$this->pwdUtilisateur',
								'$this->nomUtilisateur')";
				#echo $statement."</br>";
				#echo 1;
			}else{
				
				#UPDATE
				$statement="UPDATE {$this->table} SET
 					$this->emailCol= '$this->emailUtilisateur',	
 					$this->pwdCol= '$this->pwdUtilisateur',
 					$this->nomCol= '$this->nomUtilisateur'
 					WHERE $this->idCol=".$id;
 					#echo 2;
			}
			#Execution de le requete
			try{
			
				$queryresult= $this->getPdo()->query($statement);
				#retourner le resultat de la requete
				return $queryresult;
			
			
			}catch(Exception $e){
				echo("Erreur SaveOrUpdate:".$e->getMessage());
			}
		}else{
			
			#echo("l'adresse email est utilisé");
			return "exist";
			#echo 3;
			
		}
			
			
			
		}
		
		#READ
		public function findUtilisateur($id=null){
			if($id==null){
				#recupération de tous les utilisateurs
				$statement ="SELECT * FROM {$this->table}";
			}else{
				
				$statement="SELECT * FROM {$this->table} WHERE {$this->idCol}=".$id;
			}
			
			try{
					
				$queryresult= $this->getPdo()->query($statement);
				#retourner le resultat de la requete
				return $queryresult;
					
					
			}catch(Exception $e){
				echo("Erreur SaveOrUpdate:".$e->getMessage());
			}
		}
		
		#DELETE
		
		public function deleteUtilisateur($id){
			$statement="DELETE FROM {$this->table} WHERE {$this->idCol}=".$id;
				#Exécution de la requete
			try{
					
				$queryresult= $this->getPdo()->query($statement);
				#retourner le resultat de la requete
				return $queryresult;
					
					
			}catch(Exception $e){
				echo("Erreur SaveOrUpdate:".$e->getMessage());
			}
		}
		
		public function loginUtilisateur(){
			
			$statement="SELECT * FROM {$this->table} WHERE {$this->emailCol}='{$this->emailUtilisateur}' AND 
															{$this->pwdCol}='{$this->pwdUtilisateur}'";
			try{
			$queryresult= $this->getPdo()->query($statement)->fetchAll();
			#retourner le résultat de la requete
			#echo $queryresult->fetchColumn()."</br>";
			if($queryresult->fetchColumn() > 0)
				{
					return true;
					
				}
				else{
					return false;
					
															
					}
					}catch(Exception $e){
						echo("Erreur SaveOrUpdate:".$e->getMessage());
					}		
			
		}
			
		
	}

?>