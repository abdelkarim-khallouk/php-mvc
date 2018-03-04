<?php

	# Class STANDARD
	# Utilis� par tous les controllers
	# dans le but de r�cuperer les donn�es dans la v
	# depuis le module et de les afficher
	# grace � une m�thode prepareData()
	
	class GenericController {
		# d�finition d'une variable partag&
		# entre le controller et le generic
		# $data est un tableau qui va contenir l'ensemble des donn�es � traiter
		var $data = array();
		
		# d�finition de pr�pareData()
		# permet de pr�parer les donn�es dans un tableau accessible au GeniricController
		# le tableau accessible = var $data
		public function prepareData($data){
			# stockage des donn�es recu depuis le controller dans le GeniricController
			$this->data = array_merge($this->data,$data);
			# array_merge pemet de copier la structure et le contenu d'un tableau dans 
			# un autre afin d'eviter plusieurs traitement � la fois
		}
		
		
		public function showView($filename){
			# extraction des donn�es avec la m�thode extract()
			# pr�pareData recu le tableau $data["liste"] comme param�tre
			# qui contient des donn�es r�cup�rer du model
			# extract a le role de transformer chq case du tableau en un tableau array()
			# data["liste"] ["id_utilisateur"] = $liste["id_utilisateur"] 
			extract($this->data);
			# au moment ou extract ex�cute les donn�es sont extrait du tableau $data
			
			ob_start();
			# output_buffering_start(); temporisation de donn�es HTTP
			# autrement dit
			#ob_start() = temporisation de sortie
			#on stock les donn�es de sortie en HTTP
			#temporairement
			# require est obligatoire include non
			# int�gration de la page ou on va afficher les don�es
			# aucune donn�es n'a �t� inclus lors du require_once
			require_once (ROOT."view/".get_class($this)."/".$filename.".php");
			# resultat = PHP_MVC/view/Utilisateur/listview.php
			
			# ob_get_clean() r�cuperer les donn"es stock� en m�moire tempon
			# et efface la m�moire HTTP juste apr�s
			$content = ob_get_clean();
			echo $content;
		}
		
	}
	
?>