<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Suppression consultation
		</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<link rel="stylesheet" type ="text/css" href="style.css">
	</head>
	<body>

		<?php
			require 'sessionstart.php';
			require 'verifAuth.php';
			require 'connect.php';
			 
			if(!isset($_POST['Valider'])){
				

				$idP = $_GET['id_patient'];
				$DateRdv = $_GET['DateRdv'];
				$HeureRdv = $_GET['HeureRdv'];
			}
								
			if (isset($_POST['Valider'])) {
									
				$idP = $_POST['id_patient'];
				$DateRdv = $_POST['DateRdv'];
				$HeureRdv = $_POST['HeureRdv'];				
				$res = $linkpdo->exec("DELETE FROM consultation WHERE id_patient = '$idP' and DateRdv = '$DateRdv' and HeureRdv = '$HeureRdv'");
				if ($res == false){
			    echo 'il y a probleme methode';
			}
				
				header('Location: affichageConsultation.php');
			    exit();
									
			}
		?>

		<h1>Suppression de la consultation</h1>
		<h2>Voulez-vous supprimer la consultation ?</h2>
		<form action="supprimerConsultation.php" method="post">
			 <p><input type="hidden" name="id_patient" value="<?php echo $idP ?>" /></p>
			 <p><input type="hidden" name="DateRdv" value="<?php echo $DateRdv ?>" /></p>
			 <p><input type="hidden" name="HeureRdv" value="<?php echo $HeureRdv ?>" /></p>
			 <p><input type="submit" name="Valider" value="Valider"><input type="button" name = "Non" value="Non" onclick="history.back()"></p>
		</form>

	</body>
</html>