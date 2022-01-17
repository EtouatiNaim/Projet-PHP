
<header>
	<?php

		//Si l'utilisateur s'est bien connecté
		if(isset ($_SESSION['login']))
		{

		//Formulaire de boutons redirigeant vers les différentes pages
			?>
			<form action="menu.php" method="post">
				<p><input type="submit" name="Medecins" value="Consulter la liste des médecins">
				<input type="submit" name = "Patients" value="Consulter la liste des patients">
				<input type="submit" name = "Consultations" value="Afficher les consultations">
				<input type="submit" name = "Stats" value="Afficher les statistiques">
				<input type="submit" name = "Deco" value="Se déconnecter"></p>
			</form>
			<?php
		}
		//Si l'utilisateur n'est pas connecté
		else
		{
			//Affiche un seul bouton redirigeant vers la page de connexion
			?>
			<form action="menu.php" method="post">
				<p>
					<input type="submit" name="Connect" value="Veuillez vous connecter">
				</p>
			</form>
			<?php
		}

		//Renvoie vers la page des médecins après un clic sur le bouton médecins
		if(isset ($_POST['Medecins'])){
			header('Location: affichageMedecin.php');
		    exit();
		}

		//Renvoie vers la page des patients après un clic sur le bouton patients
		if(isset ($_POST['Patients'])){
			header('Location: affichagePatient.php');
		    exit();
		}

		//Renvoie vers la page des consultations après un clic sur le bouton consultations
		if(isset ($_POST['Consultations'])){
			header('Location: affichageConsultation.php');
		    exit();
		}

		//Renvoie vers la page des statistiques après un clic sur le bouton statistiques
		if(isset ($_POST['Stats'])){
			header('Location: statistiques.php');
		    exit();
		}

		//Renvoie vers la page de connexion/déconnexion après un clic sur le bouton connexion/déconnexion
		if(isset ($_POST['Deco']) || isset ($_POST['Connect'])){
			header('Location: auth.php');
		    exit();
		}

	?>

</header>
