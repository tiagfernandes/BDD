<?php
    require_once('fonctions.php');
    session_start ();

    $categorie= $_POST['categorie'];
    $valCategorie = $_POST['valCategorie'];

    if (!empty($categorie) && !empty($valCategorie)){

        $sql = "INSERT INTO `categorie_etiquette` (valeurCategorie, categorieEtiquette) VALUES ('$valCategorie','$categorie')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-categorie.php?succes');
    }

    else
        header('Location: ajout-categorie.php?erreur');
?>
