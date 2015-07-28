<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update-plateforme.php', formulaire de modification d'une plateforme.
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

	$idPlateforme = $_GET['update'];

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Modification Plateforme</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>
			<?php if ($_SESSION['role']== "Administrateur") {?><!-- Si l'utilisateur est Administrateur -->
				<div id="contenu">
					<div id="banniere">Modification plateforme n°<?= $idPlateforme	; ?></div>

						<?php	//fonction pour afficher le nom de l'équipement
							$resultats=$pdo->query("SELECT * FROM plateforme_archive WHERE idPlateforme_Archive = '$idPlateforme'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() )
							{
								$valeurPlateforme = $resultat->valeurPlateforme;
								$plateforme = $resultat->plateformeArchive;
							}
							$resultats->closeCursor();
						?>

						<fieldset class="Etiquette_Equipement"><legend>Plateforme d'archivage</legend>

							<!-- Formulaire d'ajout de catégorie d'étiquette équipement -->
								<form method="post" action="update_plateforme.php?idPlateforme=<?= $idPlateforme; ?>">

									<div id="Categorie_Etiquette">
										<!-- Modification de la plateforme -->
										<label id="Categorie-Etiquette">Modifier la plateforme : </label><input type="text" name="plateforme" value="<?= $plateforme; ?>"></p>

										<!-- Ajout de la valeur de la plateforme -->
										<label id="Categorie-Etiquette">Modifier la valeur de la plateforme : </label><input type="text" name="valeurPlateforme" value="<?= $valeurPlateforme; ?>"></p>

										<!-- Bouton envoie catégorie -->
										<input class="submitenvoie" type="submit" value="Modifier"><br/></p>
									</div>

									<div class="text">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/update-acronime.php?succes"){
						                          echo ("Catégorie ajouté avec succès !");
											}
										?>
									</div>

									<div id ="erreur">
										<?php
											$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
											if ($monUrl == "http://localhost/BDD/Site/update-acronime.php?erreur"){
												echo ("Veuilliez saisir tous les champs !");
											}
										?>
									</div>

								</form>
						</fieldset>

							<br>
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
