<?php
    require_once('fonctions.php');

    session_start ();

    $listeEquipement = getAllEquipement($pdo);
    $listeUtilisateur = getAllUtilisateur($pdo);
    $listeEtiquetteEquipement = getEtiquetteEquipement($pdo);

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Base de donnée ECOTRON</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


   <body>

    <?php require_once('entete.php'); ?>
        <div id ="contenu">
            <div id="banniere">Equipement</div>

			<form action ="index.php" method="get">
				<span>Recherche par numéro d'étiquette ou nom :</span>
				<input type="text" id="search" name="search"/>
				<input type="submit" value="Envoyer">
				<input type="reset" value="Annuler">
			</form>
			<?php

			if(isset($_GET['search'])) {

			$chainesearch = addslashes($_GET['search']);

			echo 'Vous avez recherché : ' . $chainesearch . '<br />';

				$requete = "SELECT *
				  			FROM `equipement`
                  			WHERE idEquipement LIKE '". $chainesearch."%'";

				// Exécution de la requête SQL
				$resultat = $pdo->query($requete) or die(print_r($pdo->errorInfo()));
				echo 'Les résultats de recherche sont : <br />';
				while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
					echo $donnees['nomEquipement'] .'<br />';
				}

			}

			?>

        </form>
        </p><table border=2>
          <th>Id</th>
          <th>Etiquette</th>
          <th>Nom équipement</th>
          <th>Fournisseur</th>
          <th>Prix (€)</th>
          <th>Marque</th>
          <th>Date d'ajout</th>
          <th>Date de fabriquation</th>
          <th>Date de réception</th>
          <th>Date de mise en service</th>
          <th>Garantie (mois)</th>

        <?php foreach ($listeEquipement as $cle=>$valeur): ?> <!--Affichage en tableau des equipement-->
            <tr>
                <form method="get" action="equipement.php?idEquipement">
                    <?php foreach ($valeur as $val): ?>
                        <?php $idEquipement=$valeur['idEquipement']; ?>
                        <td style="cursor: pointer;" onClick="window.open('equipement.php?idEquipement=<?= $idEquipement;?>')"><?= htmlentities($val) ?></td>
                    <?php endforeach; ?>
                </form>
            </tr>

         <?php endforeach; ?>

        </table>
        </div>
   </body>
</html>
