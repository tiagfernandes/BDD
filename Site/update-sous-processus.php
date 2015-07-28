<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update-sous-processus.php', formulaire de modification d'un
sous-processus.
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

	$idSousProcessus = $_GET['update'];

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Modification Sous-Processus</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>
			<?php if ($_SESSION['role']== "Administrateur") {?><!-- Si l'utilisateur est Administrateur -->
				<div id="contenu">

					<div id="banniere">Modification sous-processus n°<?= $idSousProcessus?></div>


						<?php	//fonction pour afficher le nom de l'équipement
							$resultats=$pdo->query("SELECT * FROM sous_processus WHERE idSous_Processus = '$idSousProcessus'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() )
							{
								$valeurSousProcessus = $resultat->valeurSousProcessus;
								$sousProcessus = $resultat->sousProcessus;
							}
							$resultats->closeCursor();
						?>

						<fieldset class="Etiquette_Equipement"><legend>Modification sous-processus</legend>

							<!-- Formulaire d'ajout de catégorie d'étiquette équipement -->
								<form method="post" action="update_sous_processus.php?idSousProcessus=<?= $idSousProcessus; ?>">

									<div id="Categorie_Etiquette">
										<!-- Modification de la plateforme -->
										<label id="Categorie-Etiquette">Modifier le sous-processus : </label><input type="text" name="sousProcessus" value="<?= $sousProcessus; ?>"></p>

										<!-- Ajout de la valeur de la plateforme -->
										<label id="Categorie-Etiquette">Modifier la valeur du sous-processus : </label><input type="text" name="valeurSousProcessus" value="<?= $valeurSousProcessus; ?>"></p>

										<!-- Bouton envoie catégorie -->
										<input class="submitenvoie" type="submit" value="Modifier"><br/></p>
									</div>

								</form>
						</fieldset>

							<br>
				</div>
				<?php
				}

				else{
					$message="Vous devez être Administrateur pour acceder à cette page !";
						echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
					header('refresh:0.01;url=index.php');
				}
			?>
    </body>
</html>
