<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Ajout médecin
		</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" type ="text/css" href="style.css">
	</head>
	<body>
		<?php
			//On ajoute les pages require
			require 'sessionstart.php';
			require 'verifAuth.php';
			require 'connect.php';

			//Si l'utilisateur annule on le renvoie sur lap age de saisie des médecins

			if(isset($_POST['Annuler'])) {
				header('Location: saisieMedecin.php');
	    		exit();
			}

			//On stocke les valeurs saisies

			$nom = $_POST['nom'];
			$prenom = $_POST['prenom'];
			$civilite = $_POST['civilite'];
								
			//On affiche les valeurs saisies et on demande une validation

			if(!isset ($_POST['Valider'])) {
				echo 'Nom : '.$nom.'</br>';
				echo 'Prenom : '.$prenom.'</br>';
				echo 'Civilité : '.$civilite.'</br>';
				echo "Valider l'enregistrement ?";
			}	

			//On ajoute le médecin après validation et on renvoie sur la page des médecins

			if(isset ($_POST['Valider'])){
				$SqlQuery = "INSERT INTO medecin (nom, prenom, civilite)
							VALUES ('$nom', '$prenom', '$civilite')";

				$res = $linkpdo->exec($SqlQuery);
				if ($res == false){
					echo 'il y a probleme methode';	
				}

				header('Location: affichageMedecin.php');
		   	 	exit();
			}
			
			/*On transmet les valeurs saisies*/ 
		?>

		<form action="ajoutMedecin.php" method="post">
		<p><input type="hidden" name="nom" value="<?php echo $nom ?>" /></p>
		<p><input type="hidden" name="prenom" value="<?php echo $prenom ?>" /></p>
		<p><input type="hidden" name="civilite" value="<?php echo $civilite ?>" /></p>
		 <p><input type="submit" name="Valider" value="Valider"><input type="submit" name = "Annuler" value="Annuler"></p>
		</form>

		<?php include 'footer.php'; ?>
	</body>
</html>
