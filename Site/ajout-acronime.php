<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout-acronime.php', formulaire d'insersion d'un nouveau acronime.
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

	if(isset($_GET['delete'])){ //Supprime acronime
        $id = $_GET['delete'];
        deleteAcronime($id);
    }

	$acronime = getAcronime($pdo);
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Ajout</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>

			<?php if ($_SESSION['role']== "Administrateur") { ?><!-- Si l'utilisateur est Administrateur -->

				<div id="contenu">

					<div id="banniere">Ajout d'acronime pour équipement</div>

						<fieldset class="Etiquette_Equipement"><legend>Acronime d'équipement</legend>

							<!-- Formulaire d'acronime d'étiquette -->
								<form method="post" action="ajout_acronime.php">

									<div id="acro_seul">
										<!-- Ajout d'un acronime -->
										<label id="acro_seul">Ajouter un acronime d'équipement : </label><input class="Cat-Eti" type="text" name="acronime" placeholder="Ex : Refrigerateur"></p>

										<!-- Ajout de la valeur de l'acronime -->
										<label id="acro_seul">Valeur de l'acronime d'équipement : </label><input class="Cat-Eti2" type="text" name="valAcronime" placeholder="Ex : REF"></p>

											<!-- Bouton envoie acronime -->
											<input class="submitB" type="submit" value="Ajouter"><br/></p>
									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-acronime.php?succes"){
												echo ("Acronime ajouté avec succès !");
											}
										?>
									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-acronime.php?succes_update"){
												echo ("Acronime modifié avec succès !");
											}
										?>
									</div>

									<div id ="erreur">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-acronime.php?erreur"){
												echo ("Veuilliez saisir tous les champs !");
											}
										?>
									</div>

								</form>

						</fieldset>

						<br>

						<table class="tabCatAcr" border="0.5">	<!-- Tableau avec tous les acronimes -->
								<th>id</th>
								<th>Categorie</th>
								<th>Valeur</th>

									<?php foreach ($acronime as $cle=>$valeur): ?>
										<tr>
											<?php foreach ($valeur as $val): ?>
												<td><?= htmlentities($val) ?></td>
											<?php endforeach; ?>

										<!-- Bouton modifier catégorie -->
											<td width=20px>
												<a href="update-acronime.php?update=<?= htmlentities($valeur['idAcronimeEtiquette']) ?>"><img class="modifier" border="0" alt="Image" src='./image/modifier.png' onClick="return(confirm('Modifier <?= $valeur['acronimeEtiquette']  ?> ?'));"/></a>
											</td>

										<!-- Bouton supprimer catégorie -->
											<td width=20px>
												<a href="ajout-acronime.php?delete=<?= htmlentities($valeur['idAcronimeEtiquette']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png' onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['acronimeEtiquette'] ?> ?'));"/></a>
											</td>
										</tr>
									<?php endforeach; ?>
							</table><br>

				</div>
		<?php   }

				else {
					$message="Vous devez être Administrateur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
