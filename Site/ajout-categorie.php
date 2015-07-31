<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout-anomalie.php', formulaire d'insersion d'une nouvelle anomalie.
---------------------------------------------------------------------------
L'utilisateur :
Ne peut rien faire.
---------------------------------------------------------------------------
Le développeur :
Ne peut rien faire.
---------------------------------------------------------------------------
L'administrateur :
Autorisé, peut supprimer les catégories.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

	if (isset ($_GET['delete']) ){ //Supprime categorie
        $id = $_GET['delete'];
        deleteCategorie($id);
    }

	if (isset ($_GET['update']) ){ //Modifie categorie
        $id = $_GET['update'];
        header('Location: update-categorie.php?idCategorie='.$id.'');
    }

	$categorie = getCategorie($pdo);
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Ajout catégorie</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>

			<?php if ($_SESSION['role'] == "Administrateur") { ?><!-- Si l'utilisateur est Administrateur -->

				<div id="contenu">

					<div id="banniere">Ajout catégorie pour équipement</div>

						<fieldset class="Etiquette_Equipement"><legend>Catégorie d'équipement</legend>

							<!-- Formulaire d'ajout de catégorie d'étiquette équipement -->
								<form method="post" action="ajout_categorie.php">

									<div id="Cat_Etiquette">
										<!-- Ajout d'une catégorie -->
										<label id="Cat-Etiquette">Ajouter une catégorie d'équipement : </label><input class="Cat-Eti" type="text" name="categorie" placeholder="Ex : Sensor"></p>

										<!-- Ajout de la valeur de la catégorie -->
										<label id="Cat-Etiquette">Valeur de la catégorie d'équipement : </label><input class="Cat-Eti2" type="text" name="valCategorie" placeholder="Ex : SE"></p>

										<!-- Bouton envoie catégorie -->
										<input class="submitA" type="submit" value="Envoyer"><br/></p>

									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-categorie.php?succes"){
						                          echo ("Catégorie ajouté avec succès !");
											}
										?>
									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-categorie.php?succes_update"){
						                          echo ("Catégorie modifié avec succès !");
											}
										?>
									</div>

									<div id ="erreur">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-categorie.php?erreur"){
												echo ("Veuilliez saisir tous les champs !");
											}
										?>
									</div>

								</form>

						</fieldset>

							<br>

							<table class="tabCatAcr" border="0.5">

								<th>id</th>
								<th>Categorie</th>
								<th>Valeur</th>

									<?php foreach ($categorie as $cle=>$valeur): ?>
										<tr>
											<?php foreach ($valeur as $val): ?>
												<td><?= htmlentities($val) ?></td>
											<?php endforeach; ?>

									<!-- Bouton modifier catégorie -->
											<td width=20px>
												<a href="ajout-categorie.php?update=<?= htmlentities($valeur['idCategorieEtiquette']) ?>"><img class="modifier" border="0" alt="Image" src='./image/modifier.png'
												onClick="return(confirm('Modifier <?= $valeur['categorieEtiquette']  ?> ?'));"/></a>
											</td>

									<!-- Bouton supprimer catégorie -->
											<td width=20px>
												<a href="ajout-categorie.php?delete=<?= htmlentities($valeur['idCategorieEtiquette']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
												onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['categorieEtiquette'] ?> ?'));"/></a>
											</td>
										</tr>
									<?php endforeach; ?>

							</table>
				</div>

			<?php }
				else{
					$message = "Vous devez être Administrateur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
