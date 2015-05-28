<?php
    require_once('fonctions.php');
    session_start ();

    $nom_equi= $_POST['nom_equipement'];
    /*$emplacement = $_POST['emplacement'];*/
    $prix = $_POST['prix'];
    $marque = $_POST['marque'];
    $anneefb = $_POST['anneefb'];
    $datemes = $_POST['datemes'];
    $garantie = $_POST['garantie'];
    $type = $_POST['type'];
    $plateforme = $_POST['plateforme'];
    $piece = $_POST['piece'];

    if ($plateforme !="NULL" && $piece !="NULL" && $nom_equi !=NULL){

        $sql = "INSERT INTO `equipement` (nomEquipement,prix,marque,garantie,dateFabrication,dateMiseService) VALUES ('$nom_equi','$prix','$marque','$garantie','$anneefb','$datemes')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        header('Location: ajout-element.php?succes');
    }

    else
        header('Location: ajout-element.php?erreur');
?>
