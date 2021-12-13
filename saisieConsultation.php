<!DOCTYPE HTML>
<html>
<head>
<title>
Saisie consultation
</title>
</head>
<body>

<h1>Saisie d'une consultation</h1>
<form action="ajouteConsultation.php" method="post">
 <p>Nom du patient : <input type="text" name="nomPatient" /></p>
 <p>Prénom du patient : <input type="text" name="prenomPatient" /></p>
 <p>Date du rendez-vous : <input type="date" name="DateRdv" /></p>
 <p>Heure du rendez-vous : <input type="time" name="HeureRdv" /></p>
 <p>Durée de la consultation : <input type="time" name="dureeConsultation" /></p>
 <p>Nom du médecin : 
 <?php
 require 'connect.php';
 $res = $linkpdo->prepare("SELECT nom,prenom FROM medecin");
 $res-> execute(array());
 $data = $res;
 echo '<select name="nomMedecin">';
 foreach($data as $m){
 echo '<option value='.$m['nom'].'>'.$m['nom']." ".$m['prenom'].'</option>';
 }
 echo "</select>";
 
 ?>
 </p>

 
 <p><input type="submit" value="envoyer"><input type="reset" value="vider"></p>
</form>

<p><a href=affichageConsultation.php>Retour à la liste des consultationd</a></p>

</body>
</html>