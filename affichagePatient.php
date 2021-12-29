<!DOCTYPE HTML>
<html>
<head>
<title>
Affichage patients
</title>
<link rel="stylesheet" type ="text/css" href="style.css">
</head>
<body>

<?php
//Ajout des pages require
require 'sessionstart.php';
require 'verifAuth.php';
require 'connect.php';
require 'menu.php'; 

//On récupère tous les patients de la bdd
$res = $linkpdo->query("
	SELECT civilite, nom, prenom, ville, codePostal, adresse, dateNaissance, lieuNaissance, numSecuriteSociale, id_medecin, id_patient
	FROM patient
	");
if ($res == false){
    echo 'il y a probleme methode query';
}
    ///Affichage des entrées du résultat une à une
    echo '<table border = 1>
        <tr>
			<th>civilite</th>
            <th>nom</th>
            <th>prenom</th>
            <th>ville</th>
            <th>codePostal</th>
            <th>adresse</th>
			<th>dateNaissance</th>
			<th>lieuNaissance</th>
			<th>numSecuriteSociale</th>
			<th>Médecin référent</th>
		</tr>';

while ($data = $res->fetch()) 
{
						
    echo '<tr><td>'.$data[0].'</td><td>'.$data[1].'</td><td>'.
                    $data[2].'</td><td>'.$data[3].'</td><td>'.
                    $data[4].'</td><td>'.$data[5].'</td><td>'.
                    $data[6].'</td><td>'.$data[7].'</td><td>'.
					$data[8].'</td>';
						
	$id_medecin = $data[9];
	$id_patient = $data[10];
						
						
	$res2 = $linkpdo->query("
		SELECT nom, prenom FROM medecin WHERE id_medecin = '$id_medecin'
		");
	if ($res2 == false)
	{
		echo 'il y a probleme methode query';
	}
	echo '<td>';
	while ($data = $res2->fetch()) 
	{		
		 echo $data[0].' '.$data[1];
	}
    echo "</td>";
	$res2->closeCursor();
	echo "<td>
        <a href='modificationPatient.php?id_patient=$id_patient'>modifier</a> </td><td>
        <a href='supprimerPatient.php?id_patient=$id_patient'>supprimer</a> </td></tr>";
}
///Fermeture du curseur d'analyse des résultats
$res->closeCursor();
echo '</table>';
					 
?>

<form action="saisiePatient.php" method="post">
 <p><input type="submit" name="Ajouter" value="Ajouter">
</form>

<p><a href=index.php>Accueil</a></p>

<?php include 'footer.php'; ?>
</body>
</html>