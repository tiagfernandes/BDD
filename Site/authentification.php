<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'authentification.php', formulaire de connexion.
---------------------------------------------------------------------------
L'utilisateur :
Autorisé.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

?>
<!doctype html>
<html lang="fr">
<meta charset="UTF-8">
    <head> <!--Page d'autentification-->
    	<title>Connexion</title>
			<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
		<form action="login.php" method="post" class="connexion">

            <img src="image/logo_ecotron.png" class="logo_ecotron">
            <img src="image/logo_cnrs.png" class="logo_cnrs">
            <img src="image/logo_ens.jpg" class="logo_ens">

            <hr width=335 align=left><!-- Trait de séparation -->

		<!--Connexion-->
            <label class="autentification">Votre login : </label><input id="autentification" type="text" name="login" placeholder="Identifiant"></p>
            <label class="autentification">Votre mot de passe : </label><input id="autentification" type="password" name="pwd" placeholder="Mot de Passe"></p>
            	<div id ="succes">
					<?php
						$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
						if ($monUrl == "http://localhost/BDD/Site/authentification.php?reco"){
							echo ("Changement effectué avec succès , veuillez vous reconnectez ");
						}
					?>
           		</div>

            	<div id ="erreur">
					<?php
						$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
						if ($monUrl == "http://localhost/BDD/Site/authentification.php?erreur"){
							echo ("Identifiant ou mot de passe incorrect ");
						}
					?>
            	</div>

            	<input class="log" type="submit" value="Se connecter">

        </form>
    </body>
</html>
