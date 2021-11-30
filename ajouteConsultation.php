<?php


$server = "localhost" ;
$login = "root";
$mdp = "root";
$db = "projetphp";



$id_patient = $_POST['id_patient'];
$DateRdv = $_POST['DateRdv'];
$HeureRdv = $_POST['HeureRdv'];
$dureeConsultation = $_POST['dureeConsultation'];
$id_medecin = $_POST['id_medecin'];
						
						
if(!isset ($_POST['Valider'])){
echo 'Id du patient : '.$id_patient.'</br>';
echo 'Date du rendez-vous : '.$DateRdv.'</br>';
echo 'HeureRdv : '.$HeureRdv.'</br>';
echo 'Durée de la consultation : '.$dureeConsultation.'</br>';
echo 'Id du médecin : '.$id_medecin.'</br>';

echo "Valider l'enregistrement ?";

}					

if(isset ($_POST['Valider'])){
$SqlQuery = "INSERT INTO consultation (id_patient, DateRdv, HeureRdv, dureeConsultation, id_medecin)
VALUES ('$id_patient', '$DateRdv', '$HeureRdv', '$dureeConsultation', '$id_medecin')";


///Connexion au serveur MySQL
 try {
 $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
 }
 ///Capture des erreurs éventuelles
 catch (Exception $e) {
 die('Erreur : ' . $e->getMessage());
 }

 
  $res = $linkpdo->exec($SqlQuery);
	if ($res == false){
    echo 'il y a probleme methode';
	
}

header('Location: affichageConsultation.php');
    exit();
}



?>

<form action="ajouteConsultation.php" method="post">
<p><input type="hidden" name="id_patient" value="<?php echo $id_patient ?>" /></p>
<p><input type="hidden" name="DateRdv" value="<?php echo $DateRdv ?>" /></p>
<p><input type="hidden" name="HeureRdv" value="<?php echo $HeureRdv ?>" /></p>
<p><input type="hidden" name="dureeConsultation" value="<?php echo $dureeConsultation ?>" /></p>
<p><input type="hidden" name="id_medecin" value="<?php echo $id_medecin ?>" /></p>
 <p><input type="submit" name="Valider" value="Valider"><input type="reset" name = "Annuler" value="Annuler"></p>
</form>

