<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update-sous-emplacement.php', formulaire de modification d'un
sous-emplacement.
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

	$idSousEmplacement = $_GET['update'];

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

    <head>
    	<title>Modification Sous-emplacement</title>
    		<link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    		<link rel="stylesheet" type="text/css" href="style.css">
    </head>


    <body>
		<?php require_once('entete.php'); ?>
			<?php if ($_SESSION['role']== "Administrateur") {?><!-- Si l'utilisateur est Administrateur -->
				<div id="contenu">
					<div id="banniere">Modification sous-emplacement n°<?= $idSousEmplacement ; ?></div>

						<?php	//fonction pour afficher le nom de l'équipement
							$resultats=$pdo->query("SELECT * FROM sous_emplacement WHERE idSous_Emplacement = '$idSousEmplacement'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() )
							{
								$valeurSousEmplacement = $resultat->valeurSousEmplacement;
								$sousEmplacement = $resultat->sousEmplacement;
							}
							$resultats->closeCursor();
						?>

						<fieldset class="Etiquette_Equipement"><legend>Sous-emplacement d'archivage</legend>

							<!-- Formulaire d'ajout de catégorie d'étiquette équipement -->
								<form method="post" action="update_sous-emplacement.php?idSousEmplacement=<?= $idSousEmplacement; ?>">

									<div id="Categorie_Etiquette">
										<!-- Modification de la plateforme -->
										<label id="Categorie-Etiquette">Modifier le sous-emplacement : </label><input type="text" name="sousEmplacement" value="<?= $sousEmplacement; ?>"></p>

										<!-- Ajout de la valeur de la plateforme -->
										<label id="Categorie-Etiquette">Modifier la valeur du sous-emplacement : </label><input type="text" name="valeurSousEmplacement" value="<?= $valeurSousEmplacement; ?>"></p>

										<!-- Bouton envoie catégorie -->
										<input class="submitenvoie" type="submit" value="Modifier"><br/></p>
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
