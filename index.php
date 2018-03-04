<?php
	# paramètrage du fichier .htaccess au niveau apache
	# nous avons obtenu un paramètre $_GET["p"] définie dans .htaccess
	# la page index.php : son role est de récuperer le paramètre "p" et de le restructuer
	# restructer :
	# Utilisateur est un controller et showlist est une action : showlist()
	
	# Etape 1: Red"finition des chemains vers le dossier projet : Absolet et relatif (cr"ation des context)
	# chemain relatif: script_name récuperer le chemain dossier projet: PHP_MVC sans index.php (on l'a supp par 2eme @param '')
	define('WEBROOT', str_replace('index.php','',$_SERVER["SCRIPT_NAME"]));
	# chemain absolue: script_filename récuperer le chemain complet dossier projet: PHP_MVC sans index.php (on l'a supp par 2eme @param '')
	define('ROOT', str_replace('index.php','',$_SERVER["SCRIPT_FILENAME"]));
	
	//echo WEBROOT; echo ROOT;
	
	# Etape 2: Récupération du paramètre $_GET["p"] définie dans le fichier .htaccess et qui contient
	# le controller et l'action
	
	$getparam = $_GET["p"];
	# $getparam = "Utilisateur/showlist"
	# il faudra séparer entre Utilisateur et showlist
	$paramArray = array();
	$paramArray = explode('/',$getparam);
	#explode son role est de faire le split d'une chaine de caractère, les valeurs returner par explode() dans une case tableau
	
	require_once (ROOT."module/Connexion.php");
	require_once (ROOT."module/GenericController.php");
	
	# Etape 3: Création des variables $controller et $action  début du patern MVC
	$controller = (isset($paramArray[0])?$paramArray[0]:"Utilisateur");
	$action = (isset($paramArray[1])?$paramArray[1]:"showlist");
	# si le controller est vide nous allons lui affecter une valeur
	if (empty($controller)) $controller ="Utilisateur";
	
	# Etape 4: Instancier le controller et faire appel à la méthode de l'action
	require_once ("controller/$controller.php");
	$controller = new $controller();
	
	if (method_exists($controller, $action)){
		# l'argument $controller est l'instance de new $controller
		//echo "page trouver";  PAS MARCHER
		# exemple de 3 valeurs : ou plus
		# suppression du controller et de l'action  du tableau pour y laisser que le reste des apramètres comme ID
		unset($paramArray[0]);
		unset($paramArray[1]);
		
		# call_user_func_array() son role est d'envoyer un tableu à une méthode comme paramètre
		call_user_func_array(array($controller,$action), $paramArray);
		# call_user_func_array(spécifier la méthode, le tableau à envoyer);
		
	}else {
		
		echo "Erreur 404 page not found";
	}
	
?>
	