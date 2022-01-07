<!DOCTYPE HTML>
<html>
<head>
<title>
Modification consultation
</title>
<link rel="stylesheet" type ="text/css" href="style.css">
</head>
<body>

<?php
date_default_timezone_set('UTC');
//On ajoute les pages require
require 'sessionstart.php';
require 'verifAuth.php';
require 'connect.php';
 
//On récupère les anciennes clés lorsqu'on arrive sur la page
if(!isset($_POST['Modifier'])){
	$old_id_patient = $_GET['id_patient'];
	$old_DateRdv = $_GET['DateRdv'];
	$old_HeureRdv = $_GET['HeureRdv'];
	//On récupère les données à modifier
	$res = $linkpdo->query("SELECT * FROM consultation WHERE id_patient = '$old_id_patient' and DateRdv = '$old_DateRdv' and HeureRdv = '$old_HeureRdv'");
	if ($res == false){
		echo 'il y a probleme methode query';
	}
					
	while ($data = $res->fetch()) 
	{
   
		$dureeConsultation = $data['dureeConsultation'];
		$id_medecin = $data['id_medecin'];
		///Fermeture du curseur d'analyse des résultats
        $res->closeCursor();
	}
	
	$id_patient = $old_id_patient;
	//On récupère le nom et prénom du patient avec son id			
	$res = $linkpdo->query("SELECT nom, prenom FROM patient WHERE id_patient = '$old_id_patient'");
	if ($res == false){
		echo 'il y a probleme methode query';
	}
	while ($data = $res->fetch()) {  
		$nomPatient = $data['nom'];
		$prenomPatient = $data['prenom'];
		///Fermeture du curseur d'analyse des résultats
        $res->closeCursor();
	}
	//On récupère le nom et prénom du médecin avec son id			
	$res = $linkpdo->query("SELECT nom, prenom FROM medecin WHERE id_medecin = '$id_medecin'");
	if ($res == false){
		echo 'il y a probleme methode query';
	}
	while ($data = $res->fetch()) {
        $nomMedecin = $data['nom'];
		$prenomMedecin = $data['prenom'];
		///Fermeture du curseur d'analyse des résultats
        $res->closeCursor();
	}
					
					
					
}
					
					
if (isset($_POST['Modifier'])) {
						
	$id_medecin = $_POST['id_medecin'];

	$id_patient = $_POST['id_patient'];	
	
	$DateRdv = $_POST['DateRdv'];

	$HeureRdv = $_POST['HeureRdv'];

	$dureeConsultation = $_POST['dureeConsultation'];

						
	$old_id_patient = $_POST['old_id_patient'];
	$old_DateRdv = $_POST['old_DateRdv'];
	$old_HeureRdv = $_POST['old_HeureRdv'];
						
	//On recherche si il existe déjà un rendez-vous au même moment pour le médecin
	$res = $linkpdo->query("SELECT * FROM consultation WHERE id_medecin = '$id_medecin' and DateRdv = '$DateRdv' and HeureRdv = '$HeureRdv'
	");
	//Si il existe, on stocke son id
	while ($data = $res->fetch()) {
		$id_medecin_interdit_meme_horaire = $data['id_medecin'];
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
		
		$res2 = $linkpdo->exec("UPDATE consultation SET id_patient='$id_patient', DateRdv='$DateRdv',
                           HeureRdv ='$HeureRdv', id_medecin = '$id_medecin', dureeConsultation = '$dureeConsultation' where id_patient = '$old_id_patient' and DateRdv = '$old_DateRdv' and HeureRdv = '$old_HeureRdv'");
									
		if($res2 == false)
		{
		echo 'pb ';
		}

		header('Location: affichageConsultation.php');
		exit();
	}
	else
	{	
		echo 'Le médecin ne peut pas avoir deux rendez-vous au même moment';
	}	
}


?>



<h1>Modification de consultation</h1>
<form action="modificationConsultation.php" method="post">
  <p>Nom du patient :
 <?php
 //Affichage des patients en select
 $res = $linkpdo->prepare("SELECT id_patient,nom,prenom FROM patient");
 $res-> execute(array());
 $data = $res;
 echo '<select name="id_patient">';
 foreach($data as $p){
  if( $p['id_patient'] == $id_patient)
 {

 echo "<option value='".$p['id_patient']."'selected";
 
 }
 else
 {
	 echo "<option value=".$p['id_patient'];
 }
 echo '>'.$p['nom']." ".$p['prenom'].'</option>';
 }

 echo "</select>";
 
 ?>
 </p>
 <p>Date du rendez-vous : <input type="date" name="DateRdv" value ="<?php echo $old_DateRdv; ?>" /></p>
 <p>Heure du rendez-vous : <input type="time" name="HeureRdv" value ="<?php echo $old_HeureRdv; ?>" /></p>
 <p>Durée de la consultation : <input type="time" name="dureeConsultation" value ="<?php echo $dureeConsultation; ?>" /></p>
 <p>Nom du médecin : 
  <?php

$res = $linkpdo->prepare("SELECT id_medecin,nom,prenom FROM medecin");
 $res-> execute(array());
 $data = $res;
 echo '<select name="id_medecin">';
 foreach($data as $m){
	

 if( $m['id_medecin'] == $id_medecin)
 {

 echo "<option value='".$m['id_medecin']."'selected";
 
 }
 else
 {
	 echo "<option value=".$m['id_medecin'];
 }
 echo '>'.$m['nom']." ".$m['prenom'].'</option>';
 }

 echo "</select>";
 
 ?>
 </p>


 <p><input type="hidden" name="old_id_patient" value="<?php echo $old_id_patient ?>" /></p>
  <p><input type="hidden" name="old_DateRdv" value="<?php echo $old_DateRdv ?>" /></p>
   <p><input type="hidden" name="old_HeureRdv" value="<?php echo $old_HeureRdv ?>" /></p>
 
		
 
 <p><input type="submit" name="Modifier" value="Modifier"><input type="reset" value="vider"></p>
</form>

<p><a href=affichageConsultation.php>Retour à la liste des consultations</a></p>
<?php include 'footer.php'; ?>
</body>
</html>