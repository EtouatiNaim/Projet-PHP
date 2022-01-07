<!DOCTYPE HTML>
<html>
	<head>
	<title>
	Modification patient
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

			//Si l'utilisateur n'a pas validé sa modification on récupère les données du patient qu'on souhaite modifier
			if(!isset($_POST['Modifier'])){
				$id = $_GET['id_patient'];
				$res = $linkpdo->query("SELECT * FROM patient WHERE id_Patient = '$id'");
				if ($res == false){
					echo 'il y a probleme methode query';
				}
					
			    while ($data = $res->fetch()) 
				{
			                       
					$nom = $data['nom'];
					$prenom = $data['prenom'];
					$civilite = $data['civilite'];
					$adresse = $data['adresse'];
					$codePostal = $data['codePostal'];
					$ville = $data['ville'];
					$dateNaissance = $data['dateNaissance'];
					$lieuNaissance = $data['lieuNaissance'];
					$numSecuriteSociale = $data['numSecuriteSociale'];
								
								

			        ///Fermeture du curseur d'analyse des résultats
			        $res->closeCursor();
				}
			}
								
			//Si l'utilisateur modifie les valeurs alors on récupère les valeurs saisies et on met à jour la bdd et on renvoie sur la page des patients				
			if (isset($_POST['Modifier'])) {
				$nom = $_POST['nom'];
				$prenom = $_POST['prenom'];
				$civilite = $_POST['civilite'];
				$adresse = $_POST['adresse'];
				$codePostal = $_POST['codePostal'];
				$ville = $_POST['ville'];
				$dateNaissance = $_POST['dateNaissance'];
				$lieuNaissance = $_POST['lieuNaissance'];
				$numSecuriteSociale = $_POST['numSecuriteSociale'];
				$id_medecin = $_POST['id_medecin'];
				$id = $_POST['id_Patient'];
									
				$res2 = $linkpdo->exec("UPDATE patient SET nom='$nom', prenom='$prenom',
			                            adresse='$adresse', civilite ='$civilite',  codePostal='$codePostal', ville='$ville',
			                            dateNaissance='$dateNaissance', lieuNaissance = '$lieuNaissance', numSecuriteSociale = '$numSecuriteSociale', id_medecin = '$id_medecin' where id_Patient='$id'");
												
				if($res2 == false)
				{
					echo 'Erreur';
				}

				header('Location: affichagePatient.php');
				exit();
			}



//Formulaire de changement de données
?>
<h1>Modification de patient</h1>
<form action="modificationPatient.php" method="post">
 <p>Nom du patient : <input type="text" name="nom" value ="<?php echo $nom; ?>"/></p>
 <p>Prénom du patient : <input type="text" name="prenom" value ="<?php echo $prenom; ?>"/></p>
  <p>Civilité du patient : <select name="civilite">
<option value= M.> Monsieur </option>
<option value= Mme.> Madame </option>
</select></p>
 <p>Code postal : <input type="text" name="codePostal" value ="<?php echo $codePostal; ?>"/></p>
 <p>Ville : <input type="text" name="ville" value ="<?php echo $ville; ?>"/></p>
 <p>Adresse : <input type="text" name="adresse" value ="<?php echo $adresse; ?>"/> </p>
 <p>Date de naissance : <input type="date" name="dateNaissance" value ="<?php echo $dateNaissance; ?>"/></p>
 <p>Lieu de naissance : <input type="text" name="lieuNaissance" value ="<?php echo $lieuNaissance; ?>"/> </p>
 <p>Numéro de sécurité sociale : <input type="text" name="numSecuriteSociale" value ="<?php echo $numSecuriteSociale; ?>"/></p>
  <p>Médecin référant : 
 <?php
//Affichage des médecins en select
 $res = $linkpdo->prepare("SELECT nom, prenom,id_medecin FROM medecin");
 $res-> execute(array());
 $data = $res;
 echo '<select name="id_medecin">';
 foreach($data as $m){
	echo '<option value='.$m['id_medecin'].'>'.$m['nom']." ".$m['prenom'].'</option>';
 }
 echo "</select>";
 
 ?>
 </p>
 <p><input type="hidden" name="id_Patient" value="<?php echo $id ?>" /></p>
 
 <p><input type="submit" name="Modifier" value="Modifier"><input type="reset" value="Vider"></p>
</form>


		<p><a href=affichagePatient.php>Retour à la liste des patients</a></p>

		<?php include 'footer.php'; ?>
	</body>
</html>