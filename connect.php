<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Connexion
		</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" type ="text/css" href="style.css">
	</head>
	<body>

		<?php
			//Page de connexion à notre base de données qu'on réutilise en require à chaque fois qu'on en a besoin
			$server = "eu-cdbr-west-02.cleardb.net" ;
			$login = "bda3043ef7e5a1";
			$mdp = "ce2b212f";
			$db = "heroku_0e9a38ae91e126c";
			 ///Connexion au serveur MySQL
			 try {
			 	$linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
			 }
			 ///Capture des erreurs éventuelles
			 catch (Exception $e) {
			 	die('Erreur : ' . $e->getMessage());
		 	}
		 ?>
	
	</body>
</html>
