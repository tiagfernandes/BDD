<?php
    require_once('fonctions.php');

	if(isset($_GET['delete'])){ //Supprime categorie
        $id = $_GET['delete'];
        deleteCategorie($id);
    }

	$categorie = getCategorie($pdo);
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
			<?php if ($_SESSION['role']== "Administrateur") {?>
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
							<table border="1">
								<th>id</th>
								<th>Categorie</th>
								<th>Valeur</th>
								<th>Supprimer</th>
								<th>Modifer</th>

									<?php foreach ($categorie as $cle=>$valeur): ?>
										<tr>
											<?php foreach ($valeur as $val): ?>
												<td><?= htmlentities($val) ?></td>
											<?php endforeach; ?>

									<!-- Bouton supprimer catégorie -->
											<td><a href=ajout-categorie.php?delete=<?= htmlentities($valeur['idCategorieEtiquette']) ?>
								onClick="return(confirm('Supprimer <?= $valeur['categorieEtiquette']  ?> ?'));">Supprimer</a></td>

									<!-- Bouton modifier catégorie -->
											<td><a href=ajout-categorie.php?update=<?= htmlentities($valeur['idCategorieEtiquette']) ?>
								onClick="return(confirm('Modifier <?= $valeur['categorieEtiquette']  ?> ?'));">Modifier</a></td>
										</tr>
									<?php endforeach; ?>
							</table>
				</div>

			<?php }
				else{
					$message="Vous devez être Administrateur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
