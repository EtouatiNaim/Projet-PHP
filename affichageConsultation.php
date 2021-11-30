<?php

require 'connect.php';
 

$res = $linkpdo->query("
SELECT c.DateRdv, c.HeureRdv, c.dureeConsultation, p.nom, p.prenom, m.nom, m.prenom 
FROM consultation c, patient p, medecin m
where c.id_patient = p.id_patient
and c.id_medecin = m.id_medecin
ORDER BY c.DateRdv,c.HeureRdv;");
if ($res == false){
    echo 'il y a probleme methode query';
}
                    ///Affichage des entrées du résultat une à une
                    echo '<table>
                                <tr>
										<th>Nom du patient</th>
                                        <th>Prénom du patient</th>
                                        <th>Date du rendez-vous</th>
                                        <th>Heure du rendez-vous</th>
                                        <th>Durée de la consultation</th>
                                        <th>Nom du médecin</th>
										<th>Prénom du médecin</th>
										
										</tr>';

                    while ($data = $res->fetch()) {
                        echo '<tr><td>'.$data[3].'</td><td>'.$data[4].'</td><td>'.
                        $data[0].'</td><td>'.$data[1].'</td><td>'.
                        $data[2].'</td><td>'.$data[5].'</td><td>'.
                        $data[6]."</td><tr>";
                     }
                    echo '</table>';

                     ///Fermeture du curseur d'analyse des résultats
                     $res->closeCursor();
?>

<form action="saisieConsultation.php" method="post">
 <p><input type="submit" name="Ajouter" value="Ajouter">
</form>

<p><a href=index.php>Accueil</a></p>

