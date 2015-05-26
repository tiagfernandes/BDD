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
          <th>Supprimer</th>
          <th>Modifier</th>

        <?/*php foreach ($listeUtilisateur as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>
                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

                <td><a href=admin.php?delete=<?= htmlentities($valeur['idUtilisateur']) ?>
                       onClick="return(confirm('Supprimer <?= $valeur['nomUtilisateur']  ?> ?'));">Supprimer</a></td>
                </tr>
<<<<<<< HEAD
         <?php endforeach; */?>
=======
         <?php endforeach; ?>
                <?php
>>>>>>> origin/master

                       // $delete = $pdo->prepare('DELETE FROM utilisateur WHERE idUtilisateur="'.$valeur['idUtilisateur'].'"');
                      //  $delete->execute();
                        //print_r($delete);
                ?>
        </table>
    </body>
</html>
