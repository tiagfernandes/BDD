<?php
    require_once('fonctions.php');

    $nom_equi= $_POST['nom_equipement'];
    $prix = $_POST['prix'];
    $marque = $_POST['marque'];
    $anneefb = $_POST['anneefb'];
    $datemes = $_POST['datemes'];
    $dater = $_POST['dater'];
    $garantie = $_POST['garantie'];
    $type = $_POST['type'];
    $categorie = $_POST['categorie'];
    $acronime = $_POST['acronime'];

    if ($categorie !="NULL" && $acronime !="NULL" && $nom_equi !=NULL ){

        $sql = "INSERT INTO `equipement` (nomEquipement,prix,marque,dateAjout,garantie,dateFabrication,dateReception,dateMiseService) VALUES ('$nom_equi','$prix','$marque',NOW(),'$garantie','$anneefb','$dater','$datemes')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $idequipement =$pdo->lastInsertId();

        $sql2 = "INSERT INTO `etiquette_equipement` (idCategorieEtiquette,idEquipement,idAcronimeEtiquette) VALUES ('$categorie','$idequipement','$acronime')";
        $prep2 = $pdo->prepare($sql2);
        $prep2->execute();

        header('Location: ajout-element.php?succes');
    }

    else
        header('Location: ajout-element.php?erreur');
?>
