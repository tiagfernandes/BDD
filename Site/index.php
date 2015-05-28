<?php
    require_once('fonctions.php');

    session_start ();

    $listeEquipement = getAllEquipement($pdo);
    $listeUtilisateur = getAllUtilisateur($pdo);
    $listeCategorieEquipement = getCategorieEquipement($pdo);
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
          <th>id</th>
          <th>Nom équipement</th>
          <th>Etiquette</th>
          <th>Type</th>
          <th>Marque</th>
          <th>Fournisseur</th>
          <th>Date d'ajout</th>
          <th>Date de fabriquation</th>
          <th>Date de réception</th>
          <th>Date de mise en service</th>
          <th>Prix (€)</th>
          <th>Garantie (mois)</th>

        <?php foreach ($listeEquipement as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>

               <?php foreach($listeCategorieEquipement as $cle=>$valeur): ?>
                   <tr>
                       <?php foreach ($valeur as $val): ?>
                           <td><?= htmlentities($val) ?></td>
                        <?php endforeach; ?>
                <?php endforeach; ?>

                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

         <?php endforeach; ?>



            <?php
              $query = "SELECT valeur_acronime FROM acronime_etiquette,  etiquette_equipement WHERE etiquette_equipement.idAcronimeEtiquette = acronime_etiquette.idAcronimeEtiquette AND idEtiquetteEquipement=1 ;";
              try {
                $result = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
                print_r($result);
                  }
                  catch ( Exception $e ) {
                die ("erreur dans la requete ".$e->getMessage());
                  }
            ?>
        </table>
    </div>
   </body>
</html>
