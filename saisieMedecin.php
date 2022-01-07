<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Saisie médecin
		</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" type ="text/css" href="style.css">
	</head>
	<body>

		<?php
			require 'sessionstart.php';
			require 'verifAuth.php';
		?>

		<h1>Saisie d'un nouveau médecin</h1>
		<form action="ajoutMedecin.php" method="post">
		 <p>Nom du médecin : <input type="text" name="nom" /></p>
		 <p>Prénom du médecin : <input type="text" name="prenom" /></p>
		 <p>Civilité du médecin : <select name="civilite">
		<option value= M.> Monsieur </option>
		<option value= Mme.> Madame </option>
		</select>
		</p>

		 <p><input type="submit" value="envoyer"><input type="reset" value="vider"></p>
		</form>

		<p><a href=affichageMedecin.php>Retour à la liste des médecins</a></p>

		<?php include 'footer.php'; ?>
	</body>
</html>