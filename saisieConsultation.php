<!DOCTYPE HTML>
<html>
<head>
<title>
Saisie consultation
</title>
</head>
<body>
<?php //Ajout des pages require
require 'sessionstart.php';
require 'verifAuth.php';
require 'connect.php';
?>
<h1>Saisie d'une consultation</h1>
<form action="ajouteConsultation.php" method="post">
 <p>Nom du patient :
 <?php
 //Affichage des patients en select
 $res = $linkpdo->prepare("SELECT id_patient,nom,prenom FROM patient");
 $res-> execute(array());
 $data = $res;
 echo '<select name="id_patient">';
 foreach($data as $p){
 echo '<option value='.$p['id_patient'].'>'.$p['nom']." ".$p['prenom'].'</option>';
 }
 echo "</select>";
 
 ?>
 </p>
 <p>Date du rendez-vous : <input type="date" name="DateRdv" /></p>
 <p>Heure du rendez-vous : <input type="time" name="HeureRdv" /></p>
 <p>Durée de la consultation : <input type="time" name="dureeConsultation" /></p>
 <p>Nom du médecin : 
 <?php
 //Affichage des médecins en select
 $res = $linkpdo->prepare("SELECT id_medecin,nom,prenom FROM medecin");
 $res-> execute(array());
 $data = $res;
 echo '<select name="id_medecin">';
 foreach($data as $m){
 echo '<option value='.$m['id_medecin'].'>'.$m['nom']." ".$m['prenom'].'</option>';
 }
 echo "</select>";
 
 ?>
 </p>

 
 <p><input type="submit" value="envoyer"><input type="reset" value="vider"></p>
</form>

<p><a href=affichageConsultation.php>Retour à la liste des consultations</a></p>

</body>
</html>