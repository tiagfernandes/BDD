<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout_acronime.php', permet l'insersion d'un nouveau acronime
d'étiquette.
---------------------------------------------------------------------------
L'utilisateur :
Ne peut rien faire.
---------------------------------------------------------------------------
Le développeur :
Ne peut rien faire.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');
    session_start ();

    $acronime= $_POST['acronime'];
    $valAcronime = $_POST['valAcronime'];

    if (!empty(acronime) && !empty($valAcronime)){

        $sql = "INSERT INTO `acronime_etiquette` (valeurAcronime, acronimeEtiquette) VALUES ('$valAcronime','$acronime')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        header('Location: ajout-acronime.php?succes');
    }

    else
        header('Location: ajout-acronime.php?erreur');

?>
