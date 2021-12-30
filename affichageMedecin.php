<!DOCTYPE HTML>
<html>
    <head>
        <title>
            Affichage médecins
        </title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type ="text/css" href="style.css">
    </head>
    <body>
      <div class="accueil">
        <h1>Médecin disponible</h1>
      </div>
          <?php
              require 'sessionstart.php';
              require 'verifAuth.php';
              require 'connect.php';
              require 'menu.php'; 

              $res = $linkpdo->query("SELECT * FROM medecin");

            if ($res == false){
                echo 'il y a probleme methode query';
            }  
          ?>
          <!--  Affichage des entrées du résultat une à une  -->
          <div class="Affichage-medecin">
            <?php
                echo '<table border = 1>
                  <tr>
    		      		  <th>Civilité</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                  </tr>';
                while ($data = $res->fetch()) {
                  echo '<tr><td>'.$data['civilite'].'</td><td>'.$data['nom'].'</td><td>'.
                  $data['prenom']."</td><td>
                  <a href='modificationMedecin.php?id_medecin=$data[0]' >Modifier</a> </td><td>
                  <a href='supprimerMedecin.php?id_medecin=$data[0]'>Supprimer</a> </td></tr>";
                }
              
              echo '</table>';
            

              ///Fermeture du curseur d'analyse des résultats
              $res->closeCursor();
            ?>
          </div>

          <form action="saisieMedecin.php" method="post">
             <p><input type="submit" name="Ajouter" value="Ajouter un médecin">
          </form>
      
        <p><a href=index.php> Retour à l'accueil</a></p>
        <?php include 'footer.php'; ?>
    </body>
</html>