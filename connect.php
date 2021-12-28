<!DOCTYPE HTML>
<html>
<head>
<title>
Connexion
</title>
</head>
<body>

<?php
//Page de connexion à notre base de données qu'on réutilise en require à chaque fois qu'on en a besoin
$server = "localhost" ;
$login = "root";
$mdp = "root";
$db = "projetphp";
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