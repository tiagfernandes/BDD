<?php
     require_once('fonctions.php');

     session_start ();
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

   </body>
</html>
