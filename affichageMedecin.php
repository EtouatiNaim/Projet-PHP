<!DOCTYPE HTML>
<html>
    <head>
        <title>
            Affichage médecins
        </title>
        <link rel="stylesheet" type ="text/css" href="style.css">
    </head>
    <body>

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
                <a href='modificationMedecin.php?id_medecin=$data[0]'>modifier</a> </td><td>
                <a href='supprimerMedecin.php?id_medecin=$data[0]'>supprimer</a> </td></tr>";
              }
            
            echo '</table>';
          

            ///Fermeture du curseur d'analyse des résultats
            $res->closeCursor();
          ?>

          <form action="saisieMedecin.php" method="post">
             <p><input type="submit" name="Ajouter" value="Ajouter un médecin">
          </form>
      
        <p><a href=index.php> Retour à l'accueil</a></p>
        <?php include 'footer.php'; ?>
    </body>
</html>