<?php
    require_once('fonctions.php');
    session_start ();

    $nom_equi= $_POST['nom_equipement'];
    $prix = $_POST['prix'];
    $marque = $_POST['marque'];
    $anneefb = $_POST['anneefb'];
    $datemes = $_POST['datemes'];
    $garantie = $_POST['garantie'];
    $type = $_POST['type'];
    $categorie = $_POST['categorie'];
    $acronime = $_POST['acronime'];

    if ($categorie !="NULL" && $acronime !="NULL" && $nom_equi !=NULL){

        $sql = "INSERT INTO `equipement` (nomEquipement,prix,marque,garantie,dateFabrication,dateMiseService) VALUES ('$nom_equi','$prix','$marque','$garantie','$anneefb','$datemes')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $sql2 = "INSERT INTO `etiquette_equipement` (idCategorieEtiquette,idAcronimeEtiquette) VALUES ('$categorie','$acronime')";
        $prep2 = $pdo->prepare($sql2);
        $prep2->execute();

        header('Location: ajout-element.php?succes');
    }

    else
        header('Location: ajout-element.php?erreur');
?>
