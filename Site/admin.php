<?php
    require_once('fonctions.php');

    session_start ();

    $listeUtilisateur = getAllUtilisateur($pdo);
?>

<!doctype html>
<html lang="fr">

    <head>
    <title>Page Admin</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
        <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <?php require_once('entete.php'); ?>

        <h4>Utilisateur</h4>
        <table border=2>
          <th>id</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Identifiant</th>
          <th>Mot de passe</th>
          <th>Rôle</th>
          <th>Modifier</th>
          <th>Supprimer</th>

        <?php foreach ($listeUtilisateur as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>
                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

                <td><a href=admin.php?delete=<?= htmlentities($valeur['idUtilisateur']) ?>
                       onClick="return(confirm('Etes-vous sûr de vouloir supprimer <?= $valeur['nomUtilisateur'] ?> ?'));">delete</a></td>
                <td><a href=formPDO.php?id=<?= $valeur['idUtilisateur'] ?> >update</a></td>

                </tr>
         <?php endforeach; ?>
        </table>
    </body>
</html>