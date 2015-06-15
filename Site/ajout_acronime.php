<?php
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
