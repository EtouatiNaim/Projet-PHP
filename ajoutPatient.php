<?php




$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$civilite = $_POST['civilite'];
$adresse = $_POST['adresse'];
$codePostal = $_POST['codePostal'];
$ville = $_POST['ville'];
$dateNaissance = $_POST['dateNaissance'];
$lieuNaissance = $_POST['lieuNaissance'];
$numSecuriteSociale = $_POST['numSecuriteSociale'];
$nomMedecin = $_POST['nomMedecin'];
						
if(!isset ($_POST['Valider'])){
echo 'Nom : '.$nom.'</br>';
echo 'Prenom : '.$prenom.'</br>';
echo 'Civilité : '.$civilite.'</br>';
echo 'Code postal : '.$codePostal.'</br>';
echo 'Ville : '.$ville.'</br>';
echo 'Date de naissance : '.$dateNaissance.'</br>';
echo 'Lieu de naissance : '.$lieuNaissance.'</br>';
echo 'Numéro de sécurité sociale : '.$numSecuriteSociale.'</br>';
echo 'Médecin référant : '.$nomMedecin.'</br>';
echo "Valider l'enregistrement ?";

}					





require 'connect.php';
 
  if(!isset ($_POST['Valider'])){ 
 
  $res = $linkpdo->query("SELECT id_medecin FROM medecin WHERE nom = '$nomMedecin' ");
if ($res == false){
    echo 'il y a probleme methode query';
}
 
  while ($data = $res->fetch()) {
   $id_medecin = $data[0];
   }

  }
   
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
 <p><input type="submit" name="Valider" value="Valider"><input type="reset" name = "Annuler" value="Annuler"></p>
</form>

