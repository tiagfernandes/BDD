<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update-processus.php', formulaire de modification d'un processus.
---------------------------------------------------------------------------
L'utilisateur :
N'est pas autorisé.
---------------------------------------------------------------------------
Le développeur :
N'est pas autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

	$idProcessus = $_GET['update'];

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Modification Processus</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>

			<?php if ($_SESSION['role'] == "Administrateur") { ?><!-- Si l'utilisateur est Administrateur -->

				<div id="contenu">

					<div id="banniere">Modification processus n°<?= $idProcessus?></div>

						<?php	//fonction pour afficher le nom de l'équipement
							$resultats=$pdo->query("SELECT * FROM processus WHERE idProcessus = '$idProcessus'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);

							while ($resultat = $resultats->fetch()) {
								$valeurProcessus = $resultat->valeurProcessus;
								$processus = $resultat->Processus;
							}

							$resultats->closeCursor();
						?>

						<fieldset class="Etiquette_Equipement"><legend>Modification processus</legend>

							<!-- Formulaire d'ajout de catégorie d'étiquette équipement -->
								<form method="post" action="update_processus.php?idProcessus=<?= $idProcessus; ?>">

									<div id="Categorie_Etiquette">
										<!-- Modification de la plateforme -->
										<label id="Categorie-Etiquette">Modifier le processus : </label><input type="text" name="processus" value="<?= $processus; ?>"></p>

										<!-- Ajout de la valeur de la plateforme -->
										<label id="Categorie-Etiquette">Modifier la valeur du processus : </label><input type="text" name="valeurProcessus" value="<?= $valeurProcessus; ?>"></p>

										<!-- Bouton envoie catégorie -->
										<input class="submitenvoie" type="submit" value="Modifier"><br/></p>
									</div>

								</form>

						</fieldset><br>

				</div>
				<?php
				}

				else {
					$message = "Vous devez être Administrateur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
