<?php
    require_once('fonctions.php');

	$idEquipement = $_GET['idEquipement'];

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Modifier l'équipement n°<?= $idEquipement; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>



   <body>

    <?php require_once('entete.php'); ?>
        <div id="contenu">
        	<div id="banniere">Modification de l'équipement n°<?= $idEquipement; ?></div>
          		<div id="form-ajout">
              		<fieldset><legend>Modifier</legend>

						<form method="post" action="modification_equipement.php?idEquipement=<?= $idEquipement ?>">
						<?php	//fonction pour afficher le nom de l'équipement
							$resultats=$pdo->query("SELECT * FROM equipement WHERE idEquipement='$idEquipement'");
							$resultats->setFetchMode(PDO::FETCH_OBJ);
							while( $resultat = $resultats->fetch() )
							{
								$nomEquipement = $resultat->nomEquipement;
								$prixEquipement = $resultat->prix;
								$marqueEquipement = $resultat->marque;
								$fabricationEquipement = $resultat->dateFabrication;
								$receptionEquipement = $resultat->dateReception;
								$miseServiceEquipement = $resultat->dateMiseService;
								$garantieEquipement = $resultat->garantie;
							}
							$resultats->closeCursor();
						?>
							<label id="ajout_element">Nom : </label><input type="text" name="newNom" value="<?= $nomEquipement; ?>"></p>
							<label id="ajout_element">Prix : </label><input type="double" name="newPrix" value="<?= $prixEquipement; ?>"></p>
							<label id="ajout_element">Marque : </label><input type="text" name="newMarque" value="<?= $marqueEquipement; ?>"></p>
							<label id="ajout_element">Date de fabrication : </label><input type="date" name="newDateFabrication" value="<?= $fabricationEquipement; ?>" ></p>
							<label id="ajout_element">Date de réception : </label><input type="date" name="newDateReception" value="<?= $receptionEquipement; ?>"></p>
							<label id="ajout_element">Date de mise en service : </label><input type="date" name="newDateMiseService" value="<?= $miseServiceEquipement; ?>"></p>
							<label id="ajout_element">Fin de garantie : </label><input type="date" name="newGarantie" value="<?= $garantieEquipement; ?>"></p>
							<br/>

							<input class="bouton" onclick="return(confirm('Etes-vous sur de vouloir modifier l&#180&#233quipement ? '));" type="submit" value="Modifier">
						 </form>
          			</fieldset>
        		</div>
        </div>
    </body>
</html>
