
<?php
//Vérifie que l'utilisateur est cnnecté sinon le renvoie vers la page de connexion (require)
if(!isset ($_SESSION['login'])) {				
	header('Location: auth.php');
	exit();
}			
?>
				
				
					
					
				
