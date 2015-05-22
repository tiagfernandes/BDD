<?php
    if (isset($_SESSION['nom']) && isset($_SESSION['role'])) {
        echo "<p style=text-align:right; margin-top: 10px;>Bienvenue : ".$_SESSION['nom']." ".$_SESSION['prenom']."(".$_SESSION['role'].")";
    }

    else
        header ('location: authentification.php');
?>
