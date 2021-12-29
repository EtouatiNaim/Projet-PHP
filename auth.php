<html> 
        <body>
			<?php
			require 'connect.php';
				session_name('compte');
				session_start();
				if (isset($_POST['Déconnexion'])){
				$_SESSION = array();
				}
				if (!isset($_SESSION['login'])) {
					
					
					
					if (isset($_POST['envoyer'])) {
						
					$login = $_POST['login'];
					$password = $_POST['password'];
					$password = sha1($password);
					
					
						
					$res = $linkpdo->query("SELECT * FROM compte WHERE login = '$login' and password = '$password' ");
					if ($res == false){
					echo "erreur";
					}
					
 
					while ($data = $res->fetch()) {
					$_SESSION['login'] = $data['login'];
					$_SESSION['password'] = $data['password'];
					
					
					}
					
					if(!isset($_SESSION['login'])){
						echo "Nom d'utilisateur ou mot de passe incorrect ";
					}
					}
					if (!isset($_SESSION['login'])) {
						?>
                    <form action="auth.php" method="post">
                    <p>Login : <input type="text" name="login">
					Mot de passe : <input type="text" name="password">
                    <input type="submit" name="envoyer" value="envoyer"></p>
					
					</form>
					<?php
					
						
					}
					
					
					
				}
					
                    
					
					
				
				if (isset($_SESSION['login'])) {
				?>
				
						<form method = "post">
						<p> <input type="submit" name="Déconnexion" value = "Déconnexion"/></p>
						</form>
						<?php
				}
				
				
					
				?>
				
					<p><a href=index.php>Accueil</a></p>
				
					
					
				
				
        </body>
</html>