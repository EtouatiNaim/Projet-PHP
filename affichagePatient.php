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
 

$res = $linkpdo->query("SELECT * FROM patient");
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
										</tr>';

                    while ($data = $res->fetch()) {
                        echo '<tr><td>'.$data['civilite'].'</td><td>'.$data['nom'].'</td><td>'.
                        $data['prenom'].'</td><td>'.$data['ville'].'</td><td>'.
                        $data['codePostal'].'</td><td>'.$data['adresse'].'</td><td>'.
                        $data['dateNaissance'].'</td><td>'.$data['lieuNaissance'].'</td><td>'.
						$data['numSecuriteSociale']."</td><td>
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

