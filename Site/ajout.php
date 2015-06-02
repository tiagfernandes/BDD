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
    $fournisseur = $_POST['fournisseur'];
    $type = $_POST['type'];

    if ($categorie !="NULL" && $acronime !="NULL" && $nom_equi !=NULL){

        $sql = "INSERT INTO `equipement` (nomEquipement,idType,idFournisseur,prix,marque,garantie,dateFabrication,dateMiseService) VALUES ('$nom_equi','$type','$fournisseur','$prix','$marque','$garantie','$anneefb','$datemes')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

         $recupid =$pdo->lastInsertId();

        $sql2 = "INSERT INTO `etiquette_equipement` (idCategorieEtiquette,idEquipement,idAcronimeEtiquette) VALUES ('$categorie','$recupid','$acronime')";
        $prep2 = $pdo->prepare($sql2);
        $prep2->execute();

        header('Location: ajout-element.php?succes');
    }

    else
        header('Location: ajout-element.php?erreur');
?>
