<?php
    require_once('fonctions.php');

    session_start ();

    $listeEquipement = getAllEquipement($pdo);
    $listeUtilisateur = getAllUtilisateur($pdo);
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
            <div id="banniere">
                  Equipement
            </div>

        <table border=2>
          <th>id</th>
          <th>Etiquette</th>
          <th>Nom équipement</th>
          <th>Type</th>
          <th>Lieux d'archive</th>
          <th>Fournisseur</th>
          <th>Planning d'occupation</th>
          <th>Catégorie</th>
          <th>Date d'ajout</th>

        <?php foreach ($listeEquipement as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>
                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

         <?php endforeach; ?>
        </table>
    </div>
   </body>
</html>
