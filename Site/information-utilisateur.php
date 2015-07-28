<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'information-utilisateur.php', affiche le nom, prénom et le rôle de
l'utilisateur.
---------------------------------------------------------------------------
L'utilisateur :
Autorisé.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

	if (isset($_SESSION['nom']) && isset($_SESSION['role'])) {
        echo "<p style=text-align:right; margin-top: 10px;>Bienvenue : ".$_SESSION['nom']." ".$_SESSION['prenom']." (".$_SESSION['role'].")";
    }

    else
        header ('location: authentification.php');
?>
