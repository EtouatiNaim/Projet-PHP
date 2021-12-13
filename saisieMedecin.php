<!DOCTYPE HTML>
<html>
<head>
<title>
Saisie médecin
</title>
</head>
<body>

<h1>Saisie d'un nouveau médecin</h1>
<form action="ajoutMedecin.php" method="post">
 <p>Nom du médecin : <input type="text" name="nom" /></p>
 <p>Prénom du médecin : <input type="text" name="prenom" /></p>
 <p>Civilité du médecin : <select name="civilite">
<option value= M.> Monsieur </option>
<option value= Mme.> Madame </option>
</select>
</p>

 <p><input type="submit" value="envoyer"><input type="reset" value="vider"></p>
</form>

<p><a href=affichageMedecin.php>Retour à la liste des médecins</a></p>

</body>
</html>