<?php

require 'connect.php';
 

$res = $linkpdo->query("
SELECT p.civilite, p.nom, p.prenom, p.ville, p.codePostal, p.adresse, p.dateNaissance, p.lieuNaissance, p.numSecuriteSociale, m.nom, m.prenom
FROM patient p, medecin m
WHERE p.id_medecin = m.id_medecin

");
if ($res == false){
    echo 'il y a probleme methode query';
}
                    ///Affichage des entrées du résultat une à une
                    echo '<table>
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

                    while ($data = $res->fetch()) {
                        echo '<tr><td>'.$data[0].'</td><td>'.$data[1].'</td><td>'.
                        $data[2].'</td><td>'.$data[3].'</td><td>'.
                        $data[4].'</td><td>'.$data[5].'</td><td>'.
                        $data[6].'</td><td>'.$data[7].'</td><td>'.
						$data[8].'</td><td>'.$data[9].' '.$data[10]."</td><td>
                        <a href='modificationPatient.php?id_patient=$data[0]'>modifier</a> </td><td>
                        <a href='supprimerPatient.php?id_patient=$data[0]'>supprimer</a> </td></tr>";
                     }
                    echo '</table>';

                     ///Fermeture du curseur d'analyse des résultats
                     $res->closeCursor();
?>

<form action="saisiePatient.php" method="post">
 <p><input type="submit" name="Ajouter" value="Ajouter">
</form>

<p><a href=index.php>Accueil</a></p>

