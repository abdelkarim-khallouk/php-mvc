<h1>Page showlist</h1>
<h3><a href="<?php echo WEBROOT?>Utilisateur/ajouter"> Ajouter un utilisateur </a></h3>

<ul>
<?php

	foreach ($liste as $element){
		echo ("<li>");
			echo ("Id : ".$element["id_utilisateur"]."-");
			echo ("Nom: ".$element["nom_utilisateur"]."-");
			echo ("<a href ='".WEBROOT."Utilisateur/delete/".$element["id_utilisateur"]."'> Supprimer </a>");
		echo ("</li>");
	}

?>
<ul>
