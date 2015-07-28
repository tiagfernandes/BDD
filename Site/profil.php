<?php/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'profil.php', affiche toutes les informations de l'utilisateur.
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

    require_once('fonctions.php');
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

	<head>
		<title>Profil</title>
			<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>

		<?php require_once('entete.php'); ?>
			<!--Affichage des données utilisateur-->
			<div id="contenu">
				<div id="banniere">Votre profil</div>

                <img src="image/avatar/dbz.jpg"alt="Avatar" id="avatar">

					<div id ="infos">
						<div id ="donnees">
							<?php  echo "Nom : ".$_SESSION['nom'].""; ?><p>
							<?php  echo "Prénom : ".$_SESSION['prenom'].""; ?><p>
							<?php  echo "Mail : ".$_SESSION['email'].""; ?><p>
							<?php  echo "Identifiant : ".$_SESSION['login'].""; ?><p>
							<?php  echo "Mot de passe : ".$_SESSION['password'].""; ?><p>
							<?php  echo "Rôle : ".$_SESSION['role'].""; ?>
						</div>
					</div>
				<a href="update.php" class="btn" id="bmodif">Modifier profil</a>
        	</div>
    </body>
</html>
