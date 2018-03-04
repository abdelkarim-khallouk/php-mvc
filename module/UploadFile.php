<?php

	class UploadFile{
		
		private $filename="no-image";
		
		public function upload($data){
			
			#dossier de destination
			$dossier = "../../../".$data["dossier"]."/";
			#r�cup�ration du nom r�el de l'image + son exetension
			$fichier = basename($data["basename"]);
			#r�cup�ration de l'execution uniquement
			$extension =  strtolower(pathinfo($data["basename"],PATHINFO_EXTENSION));
			echo('EXTENSION '.$extension);
			#v�rification si le type de fichier
			
			
			if($extension == "jpg" || $extension =="png" || $extension == "gif"){
				#d�placement du fichier charg� en m�moire vers le dossier de destination
				if(move_uploaded_file($data["tmpname"],$dossier.md5($fichier).".".$extension))
				{
					echo'Upload effectu� avec succ�s !<br/>';
					#md5 fonction de hachage 
					#md5 = valeur non al�atoire mais sans algorithme de retour
					#cryptage = valeur al�atoir avec algorithme de retour
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