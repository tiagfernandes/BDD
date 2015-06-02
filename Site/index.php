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

        </form>

        </p><table border=2>
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
                <?php foreach ($valeur as $val): ?>
                    <td><?= htmlentities($val) ?></td>
                <?php endforeach; ?>
            </tr>

         <?php endforeach; ?>

        </table>

    </div>
   </body>
</html>
