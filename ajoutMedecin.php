<?php

require 'connect.php';


$nom = $_POST['nom'];
						$prenom = $_POST['prenom'];
						$civilite = $_POST['civilite'];
						
						
if(!isset ($_POST['Valider'])){
echo 'Nom : '.$nom.'</br>';
echo 'Prenom : '.$prenom.'</br>';
echo 'Civilité : '.$civilite.'</br>';

echo "Valider l'enregistrement ?";

}					

if(isset ($_POST['Valider'])){
$SqlQuery = "INSERT INTO medecin (nom, prenom, civilite)
VALUES ('$nom', '$prenom', '$civilite')";




 
  $res = $linkpdo->exec($SqlQuery);
	if ($res == false){
    echo 'il y a probleme methode';
	
}

header('Location: affichageMedecin.php');
    exit();
}



?>

<form action="ajoutMedecin.php" method="post">
<p><input type="hidden" name="nom" value="<?php echo $nom ?>" /></p>
<p><input type="hidden" name="prenom" value="<?php echo $prenom ?>" /></p>
<p><input type="hidden" name="civilite" value="<?php echo $civilite ?>" /></p>
 <p><input type="submit" name="Valider" value="Valider"><input type="reset" name = "Annuler" value="Annuler"></p>
</form>

