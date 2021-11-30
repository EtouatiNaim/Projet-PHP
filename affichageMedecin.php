<?php

require 'connect.php';
 

$res = $linkpdo->query("SELECT * FROM medecin");
if ($res == false){
    echo 'il y a probleme methode query';
}
                    ///Affichage des entrées du résultat une à une
                    echo '<table>
                                <tr>
										<th>civilite</th>
                                        <th>nom</th>
                                        <th>prenom</th>
                                        
										</tr>';

                    while ($data = $res->fetch()) {
                        echo '<tr><td>'.$data['civilite'].'</td><td>'.$data['nom'].'</td><td>'.
                        $data['prenom']."</td><td>
                        <a href='modificationMedecin.php?id_medecin=$data[0]'>modifier</a> </td><td>
                        <a href='supprimerMedecin.php?id_medecin=$data[0]'>supprimer</a> </td></tr>";
                     }
                    echo '</table>';

                     ///Fermeture du curseur d'analyse des résultats
                     $res->closeCursor();
?>

<form action="saisieMedecin.php" method="post">
 <p><input type="submit" name="Ajouter" value="Ajouter">
</form>

<p><a href=index.php>Accueil</a></p>

