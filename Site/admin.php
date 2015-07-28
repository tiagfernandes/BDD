<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'admin.php', permet de visualiser tout les utilisateurs, et de les
supprimer.
---------------------------------------------------------------------------
L'utilisateur :
Ne peut rien faire.
---------------------------------------------------------------------------
Le développeur :
Ne peut rien faire.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

    if(isset($_GET['delete'])){ //Supprime utilisateur
        $id = $_GET['delete'];
        deleteUtilisateur($id);
    }

    $listeUtilisateur = getAllUtilisateur($pdo);
?>

<!doctype html>
<html lang="fr">

    <head>
		<title>Administration</title>
			<meta charset="UTF-8">
			<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <?php require_once('entete.php'); ?>
        	<?php if ($_SESSION['role']== "Administrateur") {?>
            	<div id="contenu">
               		<div id="banniere">Administration</div>

						<!-- Affichage des utilisateur -->
						<div id ="user">
							<table border=0.5>
								<th>id</th>
								<th>Nom</th>
								<th>Prénom</th>
								<th>Email</th>
								<th>Identifiant</th>
								<th>Rôle</th>
								<th>Supprimer</th>

								<!--Affichage des utilisateur-->
								<?php foreach ($listeUtilisateur as $cle=>$valeur): ?>
									<tr>
										<?php foreach ($valeur as $val): ?>
											<td><?= htmlentities($val) ?></td>
										<?php endforeach; ?>
										<!-- Bouton supprimer utilisateur -->
										<td><a href=admin.php?delete=<?= htmlentities($valeur['idUtilisateur']) ?>
											onClick="return(confirm('Supprimer <?= $valeur['prenomUtilisateur']  ?> ?'));">Supprimer</a></td>
									</tr>
								<?php endforeach; ?>
							</table>
						</div>

					<!-- Bouton pour ajouter un utilisateur -->
					<input onclick="window.location='add_user.php';"  class="button1" type="submit" value="Ajouter un utilisateur"></p>

				</div>

        <?php }
            else{	//Condition si l'utilisateur n'est pas Administrateur
                $message="Vous devez être Administrateur pour acceder à cette page !";
                echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
                header('refresh:0.01;url=index.php');
            }
        ?>
    </body>
</html>
