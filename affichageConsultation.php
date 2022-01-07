<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Affichage consultation
		</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" type ="text/css" href="style.css">
	</head>
	<body>
		<div class="accueil">
			<h1>Liste des consultations</h1>
		</div>
		<?php
		//Ajout des pages require
		require 'sessionstart.php';
		require 'verifAuth.php';
		require 'connect.php';
		require 'menu.php';

		//Menu déroulant pour filtrer les consultations en fonction du médecin
		?>
		<form action="affichageConsultation.php" method="post">
		<?php
		 $res = $linkpdo->prepare("SELECT nom,prenom, id_medecin FROM medecin");
		 $res-> execute(array());
		 $data = $res;
		 echo '<select name="id_medecin">';
		 echo '<option disabled selected value>          </option>';
		 foreach($data as $m){
			echo '<option value='.$m['id_medecin'].'>'.$m['nom']." ".$m['prenom'].'</option>';
		 }
		 echo "</select>";
		 ?>
		 <input type="submit" name="Filtrer" value="Filtrer">
		</form>
		 
		<?php
		//Si il n'y a pas de filtre on affiche toutes les consultations
		if (!isset($_POST['Filtrer']) or (!isset($_POST['id_medecin']))) {
			$res = $linkpdo->query("
			SELECT c.DateRdv, c.HeureRdv, c.dureeConsultation, p.nom, p.prenom, m.nom, m.prenom, p.id_patient
			FROM consultation c, patient p, medecin m
			where c.id_patient = p.id_patient
			and c.id_medecin = m.id_medecin
			ORDER BY c.DateRdv DESC,c.HeureRdv DESC;");
			if ($res == false){
				echo 'il y a probleme methode query';
			}
		    ///Affichage des entrées du résultat une à une
		    echo '<table border = 1>
		        <tr>
					<th>Nom du patient</th>
		            <th>Prénom du patient</th>
		            <th>Date du rendez-vous</th>
		            <th>Heure du rendez-vous</th>
		            <th>Durée de la consultation</th>
		            <th>Nom du médecin</th>
					<th>Prénom du médecin</th>
												
				</tr>';

		    while ($data = $res->fetch()) 
			{
		        echo '<tr><td>'.$data[3].'</td><td>'.$data[4].'</td><td>'.
		                        $data[0].'</td><td>'.$data[1].'</td><td>'.
		                        $data[2].'</td><td>'.$data[5].'</td><td>'.
		                        $data[6]."</td><td> 
								<a href='modificationConsultation.php?id_patient=$data[7]&DateRdv=$data[0]&HeureRdv=$data[1]'>modifier</a> </td><td>
		                        <a href='supprimerConsultation.php?id_patient=$data[7]&DateRdv=$data[0]&HeureRdv=$data[1]'>supprimer</a> </td></tr>";
		    }
		    echo '</table>';

		    ///Fermeture du curseur d'analyse des résultats
		    $res->closeCursor();
		}
		//Si il y a un filtre on n'affiche que les consultations du médecin sélectionné
		if (isset($_POST['Filtrer']) && (isset($_POST['id_medecin']))){
			
			$id_medecin = $_POST['id_medecin'];
			
			$res = $linkpdo->query("
				SELECT c.DateRdv, c.HeureRdv, c.dureeConsultation, p.nom, p.prenom, m.nom, m.prenom 
				FROM consultation c, patient p, medecin m
				where c.id_patient = p.id_patient
				and c.id_medecin = '$id_medecin'
				and c.id_medecin = m.id_medecin
				ORDER BY c.DateRdv DESC,c.HeureRdv DESC;");
			if ($res == false){
				echo 'il y a probleme methode query';
			}
		    ///Affichage des entrées du résultat une à une
		    echo '<table border = 1>
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
			
			
		}
		?>

		<form action="saisieConsultation.php" method="post">
		 <p><input type="submit" name="Ajouter" value="Ajouter">
		</form>

		<p><a href=index.php>Accueil</a></p>

		<?php include 'footer.php'; ?>
	</body>
</html>
