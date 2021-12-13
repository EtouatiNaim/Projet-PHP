<header>
<?php

session_name('compte');
session_start();

if(isset ($_SESSION['login'])){


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
else
{
	?>
	<form action="menu.php" method="post">
	<p>
	<input type="submit" name="Connect" value="Veuillez vous connecter">
</p>
</form>
	<?php
}


if(isset ($_POST['Medecins'])){
	header('Location: affichageMedecin.php');
    exit();
}

if(isset ($_POST['Patients'])){
	header('Location: affichagePatient.php');
    exit();
}

if(isset ($_POST['Consultations'])){
	header('Location: affichageConsultation.php');
    exit();
}

if(isset ($_POST['Stats'])){
	header('Location: statistiques.php');
    exit();
}

if(isset ($_POST['Deco']) || isset ($_POST['Connect'])){
	header('Location: auth.php');
    exit();
}

?>

</header>
