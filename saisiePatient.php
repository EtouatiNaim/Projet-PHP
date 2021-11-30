<h1>Saisie d'un nouvel usager</h1>
<form action="ajoutPatient.php" method="post">
 <p>Nom du patient : <input type="text" name="nom" /></p>
 <p>Prénom du patient : <input type="text" name="prenom" /></p>
 <p>Civilité du patient : <select name="civilite">
<option value= M.> Monsieur </option>
<option value= Mme.> Madame </option>
</select></p>
 <p>Code postal : <input type="text" name="codePostal" /></p>
 <p>Ville : <input type="text" name="ville" /></p>
 <p>Adresse : <input type="text" name="adresse" /></p>
 <p>dateNaissance : <input type="date" name="dateNaissance" /></p>
 <p>Lieu de naissance : <input type="text" name="lieuNaissance" /></p>
 <p>Numéro de sécurité sociale : <input type="text" name="numSecuriteSociale" /></p>
 
 <p><input type="submit" value="envoyer"><input type="reset" value="vider"></p>
</form>

<p><a href=affichagePatient.php>Retour à la liste des patients</a></p>