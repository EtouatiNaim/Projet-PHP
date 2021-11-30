<?php

require 'connect.php';
 
if(!isset($_POST['Valider'])){
	$id = $_GET['id_patient'];
}
					
if (isset($_POST['Valider'])) {
						
	$id = $_POST['id_patient'];				
	$res = $linkpdo->exec("DELETE FROM patient WHERE id_patient = '$id'");
	if ($res == false){
    echo 'il y a probleme methode';
}
	
	header('Location: affichagePatient.php');
    exit();
						
}
?>



<h1>Suppression de l'utilisateur</h1>
<h2>Voulez-vous supprimer le patient ?</h2>
<form action="supprimerPatient.php" method="post">
 <p><input type="hidden" name="id_patient" value="<?php echo $id ?>" /></p>
 <p><input type="submit" name="Valider" value="Valider"><input type="reset" name = "Non" value="Non"></p>
</form>