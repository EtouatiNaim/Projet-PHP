<!DOCTYPE HTML>
<html>
<head>
<title>
Ajout patient
</title>
</head>
<body>

<?php
//On ajoute les pages require
require 'sessionstart.php';
require 'verifAuth.php';

//Si l'utilisateur annule on le renvoie sur la page de saisie
if(isset($_POST['Annuler']))
{
	header('Location: saisiePatient.php');
    exit();
}


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

					
			
require 'connect.php';
//Si l'utilisateur n'a pas encore validé on affiche les données qu'il a saisi	
if(!isset ($_POST['Valider'])){ 
  
	echo 'Nom : '.$nom.'</br>';
	echo 'Prenom : '.$prenom.'</br>';
	echo 'Civilité : '.$civilite.'</br>';
	echo 'Code postal : '.$codePostal.'</br>';
	echo 'Ville : '.$ville.'</br>';
	echo 'Date de naissance : '.$dateNaissance.'</br>';
	echo 'Lieu de naissance : '.$lieuNaissance.'</br>';
	echo 'Numéro de sécurité sociale : '.$numSecuriteSociale.'</br>';
	
	$res = $linkpdo->query("SELECT nom FROM medecin WHERE id_medecin = '$id_medecin' ");
	if ($res == false){
		echo 'il y a probleme methode query';
	}
	while ($data = $res->fetch()) {
		$nomMedecin = $data['nom'];
	
    }
	
	echo 'Médecin référant : '.$nomMedecin.'</br>';
	
	echo "Valider l'enregistrement ?";
 

}
//Si l'utilisateur a validé, on ajoute le patient à la bdd et on le redirige vers la page des patients
if(isset ($_POST['Valider'])){ 
  
	$id_medecin = $_POST['id_medecin'];
   
	$SqlQuery = "INSERT INTO patient (nom, prenom, civilite, codePostal, ville, adresse, dateNaissance, lieuNaissance, numSecuriteSociale, id_medecin)
	VALUES ('$nom', '$prenom', '$civilite', '$codePostal', '$ville', '$adresse', '$dateNaissance', '$lieuNaissance', '$numSecuriteSociale', '$id_medecin')";

 
	$res = $linkpdo->exec($SqlQuery);
	if ($res == false){
		echo 'il y a probleme methode';
	}

header('Location: affichagePatient.php');
    exit();
}


//On transmet les données
?>

<form action="ajoutPatient.php" method="post">
<p><input type="hidden" name="nom" value="<?php echo $nom ?>" /></p>
<p><input type="hidden" name="prenom" value="<?php echo $prenom ?>" /></p>
<p><input type="hidden" name="civilite" value="<?php echo $civilite ?>" /></p>
<p><input type="hidden" name="adresse" value="<?php echo $adresse ?>" /></p>
<p><input type="hidden" name="codePostal" value="<?php echo $codePostal ?>" /></p>
<p><input type="hidden" name="ville" value="<?php echo $ville ?>" /></p>
<p><input type="hidden" name="dateNaissance" value="<?php echo $dateNaissance ?>" /></p>
<p><input type="hidden" name="lieuNaissance" value="<?php echo $lieuNaissance ?>" /></p>
<p><input type="hidden" name="numSecuriteSociale" value="<?php echo $numSecuriteSociale ?>" /></p>
<p><input type="hidden" name="id_medecin" value="<?php echo $id_medecin ?>" /></p>
 <p><input type="submit" name="Valider" value="Valider"><input type="submit" name = "Annuler" value="Annuler"></p>
</form>

</body>
</html>