<?php
     require_once('fonctions.php');

     session_start ();

    $listeEquipement = getAllEquipement($pdo);
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Index</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


   <body>
    <div id="entete">
       <?php
             if (isset($_SESSION['nom']) && isset($_SESSION['role'])) {

                echo "<p style=text-align:right;>Bienvenue : ".$_SESSION['nom']." ".$_SESSION['prenom']."(".$_SESSION['role'].")";
            }
            else
                header ('location: authentification.php');
        ?>

        <div class="bouton">
            <a href="logout.php">Déconnexion</a>
        </div>
    </div>

        <table border=2>
          <th>id</th>
          <th>Etiquette</th>
          <th>Nom équipement</th>
          <th>Type</th>
          <th>Lieux d'archive</th>
          <th>Fournisseur</th>
          <th>Planning d'occupation</th>
          <th>Panne</th>
          <th>Catégorie</th>
          <th>delete</th>
          <th>update</th>


        <?php foreach ($listeEquipement as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>
                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

            <td><a href=listeSalariesPdo.php?delete=<?= htmlentities($valeur['idsalaries']) ?>
               onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['nom'] ?> ?'));">delete</a></td>
            <td><a href=formPDO.php?id=<?= $valeur['idsalaries'] ?> >update</a></td>

            </tr>
         <?php endforeach; ?>
        </table>

   </body>
</html>
