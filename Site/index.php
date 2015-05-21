<?php
     require_once('fonctions.php');

     session_start ();
     // On teste pour voir si nos variables de session ont bien été enregistrées
     if (isset($_SESSION['nom']) && isset($_SESSION['role'])) {
         echo "<p style=text-align:right;>Bienvenue : ".$_SESSION['nom']."(".$_SESSION['role'].")";
         echo '<br><a href="./logout.php">Deconnexion</a></p>';
     }
     else
        header ('location: authentification.php');
?>

<!doctype html>
<html lang="fr">

   <head>
    <title>Index</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


   <body>
    <h1>Bienvenue</h1>
   </body>
</html>
