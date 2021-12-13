<!DOCTYPE HTML>
<html>
<head>
<title>
Ajout consultation
</title>
</head>
<body>
<?php


require 'connect.php';



$nomPatient = $_POST['nomPatient'];
$prenomPatient = $_POST['prenomPatient'];
$DateRdv = $_POST['DateRdv'];
$HeureRdv = $_POST['HeureRdv'];
$dureeConsultation = $_POST['dureeConsultation'];
$nomMedecin = $_POST['nomMedecin'];
						
						
if(!isset ($_POST['Valider'])){
echo 'Nom du patient : '.$nomPatient.'</br>';
echo 'Prenom du patient : '.$prenomPatient.'</br>';
echo 'Date du rendez-vous : '.$DateRdv.'</br>';
echo 'HeureRdv : '.$HeureRdv.'</br>';
echo 'Durée de la consultation : '.$dureeConsultation.'</br>';
echo 'Nom du médecin : '.$nomMedecin.'</br>';

echo "Valider l'enregistrement ?";

}					

if(isset ($_POST['Valider'])){
	
 $res = $linkpdo->query("SELECT id_medecin FROM medecin WHERE nom = '$nomMedecin' ");
if ($res == false){
    echo 'il y a probleme methode query';
}
 
  while ($data = $res->fetch()) {
   $id_medecin = $data[0];
   }

 $res = $linkpdo->query("SELECT id_patient FROM patient WHERE nom = '$nomPatient' and prenom = '$prenomPatient' ");
if ($res == false){
    echo 'il y a probleme methode query';
}
 
  while ($data = $res->fetch()) {
   $id_patient = $data[0];
   }
 
 $res = $linkpdo->query("SELECT * FROM consultation WHERE id_medecin = '$id_medecin' and DateRdv = '$DateRdv' and HeureRdv = '$HeureRdv')
 ");

    

	
	

	


if (mysql_num_rows($res)==0) {
$SqlQuery = "INSERT INTO consultation (id_patient, DateRdv, HeureRdv, dureeConsultation, id_medecin)
VALUES ('$id_patient', '$DateRdv', '$HeureRdv', '$dureeConsultation', '$id_medecin')";


 echo (mysql_num_rows($res));
  
 
  $res = $linkpdo->exec($SqlQuery);
	if ($res == false){
    echo 'il y a probleme methode';

}
else
{
	
	echo 'Le médecin ne peut pas avoir deux rendez-vous au même moment';
}	
}
}


?>

<form action="ajouteConsultation.php" method="post">
<p><input type="hidden" name="nomPatient" value="<?php echo $nomPatient ?>" /></p>
<p><input type="hidden" name="prenomPatient" value="<?php echo $prenomPatient ?>" /></p>
<p><input type="hidden" name="DateRdv" value="<?php echo $DateRdv ?>" /></p>
<p><input type="hidden" name="HeureRdv" value="<?php echo $HeureRdv ?>" /></p>
<p><input type="hidden" name="dureeConsultation" value="<?php echo $dureeConsultation ?>" /></p>
<p><input type="hidden" name="nomMedecin" value="<?php echo $nomMedecin ?>" /></p>
 <p><input type="submit" name="Valider" value="Valider"><input type="reset" name = "Annuler" value="Annuler"></p>
</form>

</body>
</html>