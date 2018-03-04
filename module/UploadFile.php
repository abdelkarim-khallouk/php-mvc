<?php

	class UploadFile{
		
		private $filename="no-image";
		
		public function upload($data){
			
			#dossier de destination
			$dossier = "../../../".$data["dossier"]."/";
			#récupération du nom réel de l'image + son exetension
			$fichier = basename($data["basename"]);
			#récupération de l'execution uniquement
			$extension =  strtolower(pathinfo($data["basename"],PATHINFO_EXTENSION));
			echo('EXTENSION '.$extension);
			#vérification si le type de fichier
			
			
			if($extension == "jpg" || $extension =="png" || $extension == "gif"){
				#déplacement du fichier chargé en mémoire vers le dossier de destination
				if(move_uploaded_file($data["tmpname"],$dossier.md5($fichier).".".$extension))
				{
					echo'Upload effectué avec succès !<br/>';
					#md5 fonction de hachage 
					#md5 = valeur non aléatoire mais sans algorithme de retour
					#cryptage = valeur aléatoir avec algorithme de retour
					#algorithme de retour= valeur d'origine avec hachage ou cryptage
					$image=md5($fichier).".".$extension;
					$this->filename=$image;
				}
				else
				{
					echo 'Echec de l\'upload ! <br/>';
				}
			}else{
				echo("Erreur extension <br/>");
				
			}
		}
		
		public function getFileName(){
			return $this->filename;
		}
		
	}

?>