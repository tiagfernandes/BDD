<?php
     require_once('fonctions.php');

     session_start ();

    $listeEquipement = getAllEquipement($pdo);
    $listeFournisseur = getAllFournisseur($pdo);
    $listeUtilisateur = getAllUtilisateur($pdo);
    $listeEntretient = getAllEntretient($pdo);
    $listeArchive = getAllArchive($pdo);
    $listePanne = getAllPanne($pdo);
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
            <a href="logout.php" onclick="return(confirm('Etes-vous sûr de vouloir vous déconnectez ? '));">Déconnexion</a>
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
          <th>Catégorie</th>
          <th>Supprimer</th>
          <th>Modifier</th>

        <?php foreach ($listeEquipement as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>
                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

         <?php endforeach; ?>
        </table>


        <table border=2>
          <th>idUtilisateur</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Identifiant</th>
          <th>Mot de passe</th>
          <th>Rôle</th>

        <?php foreach ($listeUtilisateur as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>
                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

         <?php endforeach; ?>
        </table>


        <table border=2>
          <th>id</th>
          <th>Fournisseur</th>
          <th>Adresse</th>
          <th>Code postal</th>
          <th>Ville</th>
          <th>Téléphone</th>

        <?php foreach ($listeFournisseur as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>
                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

         <?php endforeach; ?>
        </table>


        <table border=2>
          <th>id</th>
          <th>Date entretient</th>
          <th>Utilisateur</th>

        <?php foreach ($listeEntretient as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>
                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

         <?php endforeach; ?>
        </table>


        <table border=2>
          <th>id</th>
          <th>Plateforme</th>
          <th>Bâtiment</th>
          <th>Salle</th>
          <th>Armoire</th>
          <th>Etagère</th>

        <?php foreach ($listeArchive as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>
                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

         <?php endforeach; ?>
        </table>


        <table border=2>
          <th>id</th>
          <th>Nom panne</th>
          <th>Date de panne</th>
          <th>Date de fin de panne</th>
          <th>Description de la panne</th>
          <th>Utilisateur</th>

        <?php foreach ($listePanne as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>
                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

         <?php endforeach; ?>
        </table>
   </body>
</html>
