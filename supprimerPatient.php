<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Suppression patient
		</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" type ="text/css" href="style.css">
	</head>
	<body>

		<?php
			//Ajout des pages require
			require 'sessionstart.php';
			require 'verifAuth.php';
			require 'connect.php';

			//Si on ouvre la page pour la première fois on récupère l'id du patient à supprimer
			if(!isset($_POST['Valider'])){
				$id = $_GET['id_patient'];
			}
			//Si l'utilisateur valide la suppression on supprime le patient de la bdd et on redirige sur la page des patients			
			if (isset($_POST['Valider'])) {
									
				$id = $_POST['id_patient'];				
				$res = $linkpdo->exec("DELETE FROM patient WHERE id_patient = '$id'");
				if ($res == false){
					echo 'il y a probleme methode';
				}
				
				header('Location: affichagePatient.php');
			    exit();
									
			}
			//On transmet l'id
		?>

		<h1>Suppression de l'utilisateur</h1>
		<h2>Voulez-vous supprimer le patient ?</h2>
		<form action="supprimerPatient.php" method="post">
		 <p><input type="hidden" name="id_patient" value="<?php echo $id ?>" /></p>
		 <p><input type="submit" name="Valider" value="Valider"><input type="button" name = "Non" value="Non" onclick="history.back()"></p>
		</form>

		<?php include 'footer.php'; ?>
	</body>
</html>