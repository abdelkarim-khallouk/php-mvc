<?php

	require_once (ROOT."model/UtilisateurModel.php");

	#Ex�cution du controller: PHP_MVC/Utilisateur/showList
	#D�finition du controller
	
	class Utilisateur extends GenericController {
		
		
		#D�finition de l'action = page ou vue
		public function showlist(){
			
			$utilisateurmodel = new UtilisateurModel();
			$data = array();
			# affectation des donn�es dans la case liste du tableau $data
			$data["liste"] = $utilisateurmodel->findUtilisateur();
			# Pr�partaion des donn�es dans GenericController
			$this->prepareData($data);
			# appel � la m"thode showView() qui existe
			# dans la classe GeniricController h�rit� par le controller Utilisateur
			$this->showView("showlist");
		}
		
		#D�finition de 2eme action
		public function delete($id){
			
			echo ("suppresion d'un utilisateur ".$id[0]);
			$utilisateurmodel = new UtilisateurModel();
			$utilisateurmodel->deleteUtilisateur($id);
			$this->showlist();
			
		}
		
		public function ajouter(){
			if(!empty($_POST)){
				
				$nom = $_POST["nom"];
				$email = $_POST["email"];
				$pwd = $_POST["pwd"];
				$utilisateurmodel = new UtilisateurModel($email,$pwd,$nom);
				$utilisateurmodel->saveOrUpdate();
				$this->showlist();
			}
			else {
				
				$this->showView("ajouter");
			}
		}
		
		public function login(){
			echo ("login");
		}
		
	
	
	}

?>