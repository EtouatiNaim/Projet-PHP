<!DOCTYPE HTML>
<html>
<head>
<title>
Suppression médecin
</title>
<link rel="stylesheet" type ="text/css" href="style.css">
</head>
<body>

<?php
require 'sessionstart.php';
require 'verifAuth.php';
require 'connect.php';
 
if(!isset($_POST['Valider'])){
	$id = $_GET['id_medecin'];
}
					
if (isset($_POST['Valider'])) {
						
	$id = $_POST['id_medecin'];				
	$res = $linkpdo->exec("DELETE FROM medecin WHERE id_medecin = '$id'");
	if ($res == false){
    echo 'il y a probleme methode';
}
	
	header('Location: affichageMedecin.php');
    exit();
						
}
?>



<h1>Suppression de l'utilisateur</h1>
<h2>Voulez-vous supprimer le médecin ?</h2>
<form action="supprimerMedecin.php" method="post">
 <p><input type="hidden" name="id_medecin" value="<?php echo $id ?>" /></p>
 <p><input type="submit" name="Valider" value="Valider"><input type="button" name = "Non" value="Non" onclick="history.back()"></p>
</form>

<?php include 'footer.php'; ?>
</body>
</html>
