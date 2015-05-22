<?php
    require_once('fonctions.php');

    session_start ();

    $listeEquipement = getAllEquipement($pdo);
    $listeFournisseur = getAllFournisseur($pdo);
    $listeUtilisateur = getAllUtilisateur($pdo);
    $listeEntretient = getAllEntretient($pdo);
    $listeArchive = getAllArchive($pdo);
    $listePanne = getAllPanne($pdo);
    $listeOccupation = getAllOccupation($pdo);
    $listeLiaison = getAllLiaison($pdo);
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
            <a href="index.php">Accueil</a> |
            <a href="">Ajout équipement</a> |
            <a href="">Profil</a> |
            <a href="">Admin</a>
        </div>


        <h4>Equipement</h4>
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


        <h4>Utilisateur</h4>
        <table border=2>
          <th>id</th>
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


        <h4>Fournisseur</h4>
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


        <h4>Entretient</h4>
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


        <h4>Lieu d'archives</h4>
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


       <h4>Panne</h4>
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


        <h4>Occupation</h4>
        <table border=2>
          <th>id</th>
          <th>Date de début d'occupation</th>
          <th>Date de fin d'occupation</th>
          <th>Utilisateur</th>
          <th>Lieu d'occupation</th>

        <?php foreach ($listeOccupation as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>
                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

         <?php endforeach; ?>
        </table>


        <h4>Liaison des équipements</h4>
        <table border=2>
          <th>id</th>
          <th>Equipement 1</th>
          <th>Equipement 2</th>

        <?php foreach ($listeLiaison as $cle=>$valeur): ?>
            <tr>
            <?php foreach ($valeur as $val): ?>
                <td><?= htmlentities($val) ?></td>
            <?php endforeach; ?>

         <?php endforeach; ?>
        </table>
   </body>
</html>
