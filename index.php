<!DOCTYPE HTML>
<html>
	<head>
		<title>
			Accueil
		</title>

 		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
 		<link rel="stylesheet" type="text/css" href="style.css">
 	</head>


	<body>
	<?php
	require 'sessionstart.php';
	?>

		<div class="accueil">
			<h1>Accueil</h1>
		</div>
		<?php require 'menu.php';?>

			<table class="table-style">

			    <thead>
			        <tr><th>Jour</th>
			            <th>Lundi</th>
			         </tr>
			    </thead>
		        
		        <tbody>
			        <tr>
			            <td>Lundi</td>
			            <td>✔️ Ouvert 8h-18h</td>
			        </tr>
			        <tr>
			            <td>Mardi</td>
			            <td>✔️ Ouvert 8h-18h</td>
			        </tr>
			            <tr>
			                <td>Mercredi</td>
			                <td>✔️ Ouvert 8h-18h</td>
			            </tr>
			            <tr>
			                <td>Jeudi</td>
			                <td>✔️Ouvert 8h-18h</td>
						</tr>
			            <tr>
			                <td>Vendredi</td>
			                <td>✔️ Ouvert 8h-18h</td>
			            </tr>
			             <tr>
			                <td>Samedi</td>
			                <td>✔️Ouvert 9h-12h</td>

			            </tr>
			             <tr>
			                <td>Dimanche</td>
			                <td>❌Fermé</td>
			            </tr>

			    </tbody>

		    </table>
	<?php include 'footer.php'; ?>
	</body>
	
</html>