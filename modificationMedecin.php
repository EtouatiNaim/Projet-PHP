<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Modification medecin
		</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" type ="text/css" href="style.css">
	</head>
	<body>

		<?php
			require 'sessionstart.php';
			require 'verifAuth.php';
			require 'connect.php';
			 
			if(!isset($_POST['Modifier'])){
				$id = $_GET['id_medecin'];
				$res = $linkpdo->query("SELECT * FROM medecin WHERE id_medecin = '$id'");
				if ($res == false){
				    echo 'il y a probleme methode query';
				}
									
	            while ($data = $res->fetch()) {
	               
					$nom = $data['nom'];
					$prenom = $data['prenom'];
					$civilite = $data['civilite'];
	             ///Fermeture du curseur d'analyse des résultats
	             $res->closeCursor();
				}
			}
				
			if (isset($_POST['Modifier'])) {
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$civilite = $_POST['civilite'];
				
				$id = $_POST['id_medecin'];
				
				$res2 = $linkpdo->exec("UPDATE medecin SET nom='$nom', prenom='$prenom',
                             civilite ='$civilite' where id_medecin='$id'");
							
				if($res2 == false)
				{
					echo 'pb prout';
				}

				header('Location: affichageMedecin.php');
				exit();
			}
		?>


<h1>Modification de médecin</h1>
<form action="modificationMedecin.php" method="post">
 <p>Nom du médecin : <input type="text" name="nom" value ="<?php echo $nom; ?>"/></p>
 <p>Prénom du médecin : <input type="text" name="prenom" value ="<?php echo $prenom; ?>"/></p>
  <p>Civilité du médecin : <select name="civilite">
<option value= M.> Monsieur </option>
<option value= Mme.> Madame </option>
</select></p>
 <p><input type="hidden" name="id_medecin" value="<?php echo $id ?>" /></p>
 
 <p><input type="submit" name="Modifier" value="Modifier"><input type="reset" value="Vider"></p>
</form>


		<p><a href=affichageMedecin.php>Retour à la liste des médecins</a></p>

	</body>
</html>
