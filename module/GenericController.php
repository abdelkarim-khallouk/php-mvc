<?php

	# Class STANDARD
	# Utilisé par tous les controllers
	# dans le but de récuperer les données dans la v
	# depuis le module et de les afficher
	# grace à une méthode prepareData()
	
	class GenericController {
		# définition d'une variable partag&
		# entre le controller et le generic
		# $data est un tableau qui va contenir l'ensemble des données à traiter
		var $data = array();
		
		# définition de prépareData()
		# permet de préparer les données dans un tableau accessible au GeniricController
		# le tableau accessible = var $data
		public function prepareData($data){
			# stockage des données recu depuis le controller dans le GeniricController
			$this->data = array_merge($this->data,$data);
			# array_merge pemet de copier la structure et le contenu d'un tableau dans 
			# un autre afin d'eviter plusieurs traitement à la fois
		}
		
		
		public function showView($filename){
			# extraction des données avec la méthode extract()
			# prépareData recu le tableau $data["liste"] comme paramètre
			# qui contient des données récupérer du model
			# extract a le role de transformer chq case du tableau en un tableau array()
			# data["liste"] ["id_utilisateur"] = $liste["id_utilisateur"] 
			extract($this->data);
			# au moment ou extract exécute les données sont extrait du tableau $data
			
			ob_start();
			# output_buffering_start(); temporisation de données HTTP
			# autrement dit
			#ob_start() = temporisation de sortie
			#on stock les données de sortie en HTTP
			#temporairement
			# require est obligatoire include non
			# intégration de la page ou on va afficher les donées
			# aucune données n'a été inclus lors du require_once
			require_once (ROOT."view/".get_class($this)."/".$filename.".php");
			# resultat = PHP_MVC/view/Utilisateur/listview.php
			
			# ob_get_clean() récuperer les donn"es stocké en mémoire tempon
			# et efface la mémoire HTTP juste après
			$content = ob_get_clean();
			echo $content;
		}
		
	}
	
?>