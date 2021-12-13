<!DOCTYPE HTML>
<html>
<head>
<title>
Statistiques
</title>
</head>
<body>
<?php
require 'menu.php';
require 'connect.php';



$res = $linkpdo->query("SELECT COUNT(*) FROM patient WHERE patient.civilite = 'M.' and DATEDIFF(DATE(now()),patient.dateNaissance) < 9131 ");
if ($res == false){
    echo 'il y a probleme methode query';
}
 
  while ($data = $res->fetch()) {
   $inf25Homme = $data[0];
   }

?>

<table border = 1>
<tr>
    <td class = "titre">Tranche d'âge</td>
    <td class="titre">Nb hommes</td>
    <td class="titre">Nb femmes</td>
</tr>
<tr>
    <td class="titre">Moins de 25 ans</td>
<?php
$res = $linkpdo->query("SELECT COUNT(*) FROM patient WHERE patient.civilite = 'M.' and DATEDIFF(DATE(now()),patient.dateNaissance) < 9131 ");
if ($res == false){
    echo 'il y a probleme methode query';
}
 
  while ($data = $res->fetch()) {
   echo '<td>'.$data[0].'</td>';
   }

$res = $linkpdo->query("SELECT COUNT(*) FROM patient WHERE patient.civilite = 'Mme.' and DATEDIFF(DATE(now()),patient.dateNaissance) < 9131 ");
if ($res == false){
    echo 'il y a probleme methode query';
}
 
  while ($data = $res->fetch()) {
   echo '<td>'.$data[0].'</td>';
   }   
?>
</tr>
<tr>
    <td  class="titre">Entre 25 et 50 ans</td>
    <?php
$res = $linkpdo->query("SELECT COUNT(*) FROM patient WHERE patient.civilite = 'M.' and DATEDIFF(DATE(now()),patient.dateNaissance) > 9131 and DATEDIFF(DATE(now()),patient.dateNaissance) < 18262");
if ($res == false){
    echo 'il y a probleme methode query';
}
 
  while ($data = $res->fetch()) {
   echo '<td>'.$data[0].'</td>';
   }

$res = $linkpdo->query("SELECT COUNT(*) FROM patient WHERE patient.civilite = 'Mme.' and DATEDIFF(DATE(now()),patient.dateNaissance) > 9131 and DATEDIFF(DATE(now()),patient.dateNaissance) < 18262  ");
if ($res == false){
    echo 'il y a probleme methode query';
}
 
  while ($data = $res->fetch()) {
   echo '<td>'.$data[0].'</td>';
   }   
?>
</tr>

<tr>
    <td  class="titre">Plus de 50 ans</td>
        <?php
$res = $linkpdo->query("SELECT COUNT(*) FROM patient WHERE patient.civilite = 'M.' and DATEDIFF(DATE(now()),patient.dateNaissance) > 18262");
if ($res == false){
    echo 'il y a probleme methode query';
}
 
  while ($data = $res->fetch()) {
   echo '<td>'.$data[0].'</td>';
   }

$res = $linkpdo->query("SELECT COUNT(*) FROM patient WHERE patient.civilite = 'Mme.' and DATEDIFF(DATE(now()),patient.dateNaissance) > 18262");
if ($res == false){
    echo 'il y a probleme methode query';
}
 
  while ($data = $res->fetch()) {
   echo '<td>'.$data[0].'</td>';
   }   
?>
</tr>
</table>
<p><a href=index.php>Accueil</a></p>
<?php
$res = $linkpdo->query("
    
select m.nom, m.prenom,
sum(TIME_TO_SEC(c.dureeConsultation))
from medecin m, consultation c
where m.id_medecin = c.id_medecin
group by m.nom");
if ($res == false){
    echo 'il y a probleme methode query';
}
                    ///Affichage des entrées du résultat une à une
                    echo "<table border = 1>
                                <tr>
										<th>Médecin</th>
                                        <th>Nombre d'heures de consultation</th>
                                        
										
										</tr>";

                    while ($data = $res->fetch()) {
						$data[2] = $data[2]/3600.0;
                        echo '<tr><td>'.$data[0].$data[1].'</td><td>'.$data[2]."</td><tr>";
                     }
                    echo '</table>';
					

?>

<p><a href=index.php>Accueil</a></p>

<?php

?>
</body>
</html>