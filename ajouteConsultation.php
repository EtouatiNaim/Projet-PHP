<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Ajout consultation
		</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" type ="text/css" href="style.css">
	</head>
	<body>
		<?php
			//Ajoute les différentes pages require
			require 'sessionstart.php';
			require 'verifAuth.php';
			require 'connect.php';


			//Récupères les données saisies par l'utilisateur sur la page précédente
			$id_patient = $_POST['id_patient'];

			$DateRdv = $_POST['DateRdv'];
			$HeureRdv = $_POST['HeureRdv'];
			$dureeConsultation = $_POST['dureeConsultation'];
			$id_medecin = $_POST['id_medecin'];
									
			//Affiche les données et demande une validation à l'utilisateur					
			if(!isset ($_POST['Valider'])){
				
				$res = $linkpdo->query("SELECT nom, prenom FROM patient WHERE id_patient = '$id_patient' ");
				if ($res == false){
					echo 'il y a probleme methode query';
				}
				while ($data = $res->fetch()) {
					$nomPatient = $data['nom'];
					$prenomPatient = $data['prenom'];
			    }
				
				$res = $linkpdo->query("SELECT nom FROM medecin WHERE id_medecin = '$id_medecin' ");
				if ($res == false){
					echo 'il y a probleme methode query';
				}
				while ($data = $res->fetch()) {
					$nomMedecin = $data['nom'];
				
			    }
				
				echo 'Nom du patient : '.$nomPatient.'</br>';
				echo 'Prenom du patient : '.$prenomPatient.'</br>';
				echo 'Date du rendez-vous : '.$DateRdv.'</br>';
				echo 'HeureRdv : '.$HeureRdv.'</br>';
				echo 'Durée de la consultation : '.$dureeConsultation.'</br>';
				echo 'Nom du médecin : '.$nomMedecin.'</br>';

				echo "Valider l'enregistrement ?";


}
//Si l'utilisateur annule sa saisie on le redirige sur la page de saisie
if(isset($_POST['Annuler']))
{
	header('Location: saisieConsultation.php');
    exit();
}
//Si l'utilisateur valide on lance la requête pour ajouter la nouvelle consultation à la base de données
if(isset ($_POST['Valider'])){
	
	
   
   
	//On recherche si il existe déjà un rendez-vous au même moment pour le médecin
	$res = $linkpdo->query("SELECT * FROM consultation WHERE id_medecin = '$id_medecin' and DateRdv = '$DateRdv' and HeureRdv = '$HeureRdv'
	");
	//Si il existe, on stocke son id
	while ($data = $res->fetch()) {
		$id_medecin_interdit = $data['id_medecin'];
	}
	//On recherche les consultations du médecin à la même date
	$res = $linkpdo->query("SELECT * FROM consultation WHERE id_medecin = '$id_medecin' and DateRdv = '$DateRdv' and '$HeureRdv' between HeureRdv and addtime(HeureRdv,dureeConsultation)
                                        or addtime('$HeureRdv','$dureeConsultation') between HeureRdv and addtime(HeureRdv,dureeConsultation)
	");

    
	
	//On vérifie qu'il n'y a pas de chevauchement de consultations en fonction de leur durée

	while ($data = $res->fetch()) {
		
	$id_medecin_interdit_chevauchement = $data['id_medecin'];

   }
	
	//Si il n'y a aucun chevauchement par heure exacte ou par durée de consultation, on crée la consultation dans la base de données
	if (!isset($id_medecin_interdit_meme_horaire) && !isset($id_medecin_interdit_chevauchement)) {		
		$SqlQuery = "INSERT INTO consultation (id_patient, DateRdv, HeureRdv, dureeConsultation, id_medecin)
		VALUES ('$id_patient', '$DateRdv', '$HeureRdv', '$dureeConsultation', '$id_medecin')";


					$res2 = $linkpdo->exec($SqlQuery);

			  
					header('Location: affichageConsultation.php');
					exit();
				
				}
				else
				{	
					echo 'Le médecin ne peut pas avoir deux rendez-vous au même moment';
				}	

			}

			//On transmet les valeurs saisies précédemment lorsqu'on rafraichit la page apprès appui sur un bouton
		?>

		<form action="ajouteConsultation.php" method="post">
			<p><input type="hidden" name="id_patient" value="<?php echo $id_patient ?>" /></p>
			<p><input type="hidden" name="DateRdv" value="<?php echo $DateRdv ?>" /></p>
			<p><input type="hidden" name="HeureRdv" value="<?php echo $HeureRdv ?>" /></p>
			<p><input type="hidden" name="dureeConsultation" value="<?php echo $dureeConsultation ?>" /></p>
			<p><input type="hidden" name="id_medecin" value="<?php echo $id_medecin ?>" /></p>
			<p><input type="submit" name="Valider" value="Valider"><input type="submit" name = "Annuler" value="Annuler"></p>
		</form>

		<?php include 'footer.php'; ?>

	</body>
</html>