<?php
    require_once('fonctions.php');
    session_start ();

    $nom_equi= $_POST['nom_equipement'];
    $emplacement = $_POST['emplacement'];
    $prix = $_POST['prix'];
    $marque = $_POST['marque'];
    $anneefb = $_POST['anneefb'];
    $datemes = $_POST['datemes'];
    $garantie = $_POST['garantie'];
    $type = $_POST['type'];
    $plateforme = $_POST['plateforme'];
    $piece = $_POST['piece'];

    if ($plateforme !="NULL" && $piece !="NULL"){
        echo( "Etiquette : <b>".$plateforme."-".$piece."</b><br>\n" ) ;

        $query = "INSERT INTO equipement ('nomEquipement') VALUES ".$nom_equi."";
        $prep = $pdo->prepare($query);
        $prep->execute();
    }

    else
        header('Location: ajout-element.php?erreur');
?>
