<h1>Saisie d'une consultation</h1>
<form action="ajouteConsultation.php" method="post">
 <p>Id du patient : <input type="text" name="id_patient" /></p>
 <p>Date du rendez-vous : <input type="date" name="DateRdv" /></p>
 <p>Heure du rendez-vous : <input type="text" name="HeureRdv" /></p>
 <p>Durée de la consultation : <input type="text" name="dureeConsultation" /></p>
 <p>Id du médecin : <input type="text" name="id_medecin" /></p>

 
 <p><input type="submit" value="envoyer"><input type="reset" value="vider"></p>
</form>

<p><a href=affichageConsultation.php>Retour à la liste des consultationd</a></p>