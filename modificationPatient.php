<?php

$server = "localhost" ;
$login = "root";
$mdp = "root";
$db = "projetphp";
 ///Connexion au serveur MySQL
 try {
 $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
 }
 ///Capture des erreurs éventuelles
 catch (Exception $e) {
 die('Erreur : ' . $e->getMessage());
 }
 
if(!isset($_POST['Modifier'])){
	$id = $_GET['id_patient'];
	$res = $linkpdo->query("SELECT * FROM patient WHERE id_Patient = '$id'");
if ($res == false){
    echo 'il y a probleme methode query';
}
					
                    while ($data = $res->fetch()) {
                       
					$nom = $data['nom'];
					$prenom = $data['prenom'];
					$civilite = $data['civilite'];
					$adresse = $data['adresse'];
					$codePostal = $data['codePostal'];
					$ville = $data['ville'];
					$dateNaissance = $data['dateNaissance'];
					$lieuNaissance = $data['lieuNaissance'];
					$numSecuriteSociale = $data['numSecuriteSociale'];
					
					

                     ///Fermeture du curseur d'analyse des résultats
                     $res->closeCursor();
					}
					}
					
					
					if (isset($_POST['Modifier'])) {
						$nom = $_POST['nom'];
						$prenom = $_POST['prenom'];
						$civilite = $_POST['civilite'];
						$adresse = $_POST['adresse'];
						$codePostal = $_POST['codePostal'];
						$ville = $_POST['ville'];
						$dateNaissance = $_POST['dateNaissance'];
						$lieuNaissance = $_POST['lieuNaissance'];
						$numSecuriteSociale = $_POST['numSecuriteSociale'];
						$id = $_POST['id_Patient'];
						
						$res2 = $linkpdo->exec("UPDATE patient SET nom='$nom', prenom='$prenom',
                                    adresse='$adresse', civilite ='$civilite',  codePostal='$codePostal', ville='$ville',
                                    dateNaissance='$dateNaissance', lieuNaissance = '$lieuNaissance', numSecuriteSociale = '$numSecuriteSociale' where id_Patient='$id'");
									
						if($res2 == false)
						{
							echo 'pb prout';
						}

						header('Location: affichagePatient.php');
						exit();
					}



?>



<h1>Modification de patient</h1>
<form action="modificationPatient.php" method="post">
 <p>Nom du patient : <input type="text" name="nom" value ="<?php echo $nom; ?>"/></p>
 <p>Prénom du patient : <input type="text" name="prenom" value ="<?php echo $prenom; ?>"/></p>
 <p>Civilité du patient : <input type="text" name="civilite" value ="<?php echo $civilite; ?>"/> </p>
 <p>Code postal : <input type="text" name="codePostal" value ="<?php echo $codePostal; ?>"/></p>
 <p>Ville : <input type="text" name="ville" value ="<?php echo $ville; ?>"/></p>
 <p>Adresse : <input type="text" name="adresse" value ="<?php echo $adresse; ?>"/> </p>
 <p>Date de naissance : <input type="date" name="dateNaissance" value ="<?php echo $dateNaissance; ?>"/></p>
 <p>Lieu de naissance : <input type="text" name="lieuNaissance" value ="<?php echo $lieuNaissance; ?>"/> </p>
 <p>Numéro de sécurité sociale : <input type="text" name="numSecuriteSociale" value ="<?php echo $numSecuriteSociale; ?>"/></p>
 <p><input type="hidden" name="id_Patient" value="<?php echo $id ?>" /></p>
 
 <p><input type="submit" name="Modifier" value="Modifier"><input type="reset" value="vider"></p>
</form>

<p><a href=affichagePatient.php>Retour à la liste des patients</a></p>