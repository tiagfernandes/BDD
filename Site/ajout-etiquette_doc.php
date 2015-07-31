<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout-etiquette.php', formulaire d'insersion d'une nouvelle
catégorie, d'un nouveau acronime.
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

	if(isset($_GET['delete_type'])){ //Supprime le type
        $id = $_GET['delete_type'];
        deleteType($id);
    }

	if(isset($_GET['delete_processus'])){ //Supprime le processus
        $id = $_GET['delete_processus'];
        deleteProcessus($id);
    }

	if(isset($_GET['delete_sous_processus'])){ //Supprime le sous processus
        $id = $_GET['delete_sous_processus'];
        deleteSousProcessus($id);
    }


	$listeType = getAllType($pdo);
	$listeProcessus = getAllProcessus($pdo);
	$listeSousProcessus = getAllSousProcessus($pdo);

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Ajout étiquette document</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css" />
    </head>


    <body>
		<?php require_once('entete.php'); ?>

			<?php if ($_SESSION['role']== "Administrateur") { ?><!-- Si l'utilisateur est Administrateur -->

				<div id="contenu">

					<div id="banniere">Ajout d'étiquette de document</div>

						<fieldset class="Etiquette_Equipement"><legend>Etiquette document</legend>

							<!-- Formulaire d'ajout de lieu d'archive -->
								<div id="form-ajout">

									<form method="get" action="ajout_type.php">

										<!-- Ajout d'une plateforme -->
										<label id="ajout_element">Ajouter un type : </label><input class="" type="text" name="val_type" placeholder="Valeur type"> - <input class="" type="text" name="type" placeholder="Type">
											<input class="" type="submit" value="Ajouter"></p>

									</form>

								<hr><!-- Trait de séparation --></hr>

									<form method="get" action="ajout_processus.php">

										<!-- Ajout d'une piece -->
										<label id="ajout_element">Ajouter un processus : </label><input class="" type="text" name="val_processus" placeholder="Valeur processus"> - <input class="" type="text" name="processus" placeholder="Processus">
											<input class="" type="submit" value="Ajouter"></p>

									</form>

								<hr><!-- Trait de séparation --></hr>

									<form method="get" action="ajout_sous_processus.php">

										<label id="ajout_element">Ajouter un sous-processus : </label><input class="" type="text" name="val_sous_processus" placeholder="Valeur sous-processus"> - <input class="" type="text" name="sous-processus" placeholder="Processus">
											<input class="" type="submit" value="Ajouter"></p>

									</form>


									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-archivage.php?succes_plateforme") {
												echo ("Plateforme ajouté avec succès !");
											}
										?>
									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-archivage.php?succes_piece") {
												echo ("Pièce ajouté avec succès !");
											}
										?>
									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-archivage.php?succes_emplacement") {
												echo ("Emplacement ajouté avec succès !");
											}
										?>
									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-archivage.php?succes_s_emplacement") {
												echo ("Sous emplacement ajouté avec succès !");
											}
										?>
									</div>

									<div id ="erreur">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/ajout-archivage.php?erreur") {
												echo ("Veuilliez saisir un champ !");
											}
										?>
									</div>

								</div>

						</fieldset><br>


								<table class="tabCatAcr" style="border: 2px solid #4f426c">

									<th>id</th>
									<th width=200px>Valeur Type</th>
									<th width=200px>Type</th>

										<?php foreach ($listeType as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

											<!-- Bouton modifier catégorie -->
												<td width=20px>
													<a href="update-type.php?update=<?= htmlentities($valeur['idType_Document']) ?>"><img class="modifier" border="0" alt="Image" src='./image/modifier.png'
													onClick="return(confirm('Modifier <?= $valeur['typeDocument']  ?> ?'));"/></a>
												</td>

											<!-- Bouton supprimer catégorie -->
												<td width=20px>
													<a href="ajout-etiquette_doc.php?delete_type=<?= htmlentities($valeur['idType_Document']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
													onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['typeDocument'] ?> ?'));"/></a>
												</td>
											</tr>
										<?php endforeach; ?>

								</table><br>


								<table class="tabCatAcr" style="border: 2px solid #4f426c">

									<th>id</th>
									<th width=200px>Valeur processus</th>
									<th width=200px>Processus</th>

										<?php foreach ($listeProcessus as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

											<!-- Bouton modifier catégorie -->
												<td width=20px>
													<a href="update-processus.php?update=<?= htmlentities($valeur['idProcessus']) ?>"><img class="modifier" border="0" alt="Image" src='./image/modifier.png'
													onClick="return(confirm('Modifier <?= $valeur['Processus']  ?> ?'));"/></a>
												</td>

											<!-- Bouton supprimer catégorie -->
												<td width=20px>
													<a href="ajout-etiquette_doc.php?delete_processus=<?= htmlentities($valeur['idProcessus']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
													onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['Processus'] ?> ?'));"/></a>
												</td>

											</tr>
										<?php endforeach; ?>

								</table><br>


								<table class="tabCatAcr" style="border: 2px solid #4f426c">

									<th>id</th>
									<th width=200px>Valeur sous-processus</th>
									<th width=200px>Sous-processus</th>

										<?php foreach ($listeSousProcessus as $cle=>$valeur): ?>
											<tr>
												<?php foreach ($valeur as $val): ?>
													<td><?= htmlentities($val) ?></td>
												<?php endforeach; ?>

											<!-- Bouton modifier catégorie -->
												<td width=20px>
													<a href="update-sous-processus.php?update=<?= htmlentities($valeur['idSous_Processus']) ?>"><img class="modifier" border="0" alt="Image" src='./image/modifier.png'
													onClick="return(confirm('Modifier <?= $valeur['sousProcessus']  ?> ?'));"/></a>
												</td>

											<!-- Bouton supprimer catégorie -->
												<td width=20px>
													<a href="ajout-etiquette_doc?delete_sous_processus=<?= htmlentities($valeur['idSous_Processus']) ?>"><img class="poubelle" border="0" alt="Image" src='./image/poubelle1.png'
													onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['sousProcessus'] ?> ?'));"/></a>
												</td>
											</tr>
										<?php endforeach; ?>

								</table><br>


				</div>
			<?php }
				else {
					$message = "Vous devez être Administrateur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
