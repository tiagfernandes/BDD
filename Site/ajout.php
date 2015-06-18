<?php
    require_once('fonctions.php');

    $nom_equi= $_POST['nom_equipement'];
    $prix = $_POST['prix'];
    $marque = $_POST['marque'];
    $anneefb = $_POST['anneefb'];
    $datemes = $_POST['datemes'];
    $dater = $_POST['dater'];
    $garantie = $_POST['garantie'];
    $categorie = $_POST['categorie'];
    $acronime = $_POST['acronime'];
    $plateforme = $_POST['plateforme'];

    if ($categorie!="NULL" && $acronime!="NULL" && $nom_equi!=NULL && $plateforme!=NULL){

        $sql = "INSERT INTO `equipement` (nomEquipement,prix,marque,dateAjout,garantie,dateFabrication,dateReception,dateMiseService, idPlateforme) VALUES ('$nom_equi','$prix','$marque',NOW(),'$garantie','$anneefb','$dater','$datemes', '$plateforme')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $idequipement =$pdo->lastInsertId();

        $sql2 = "INSERT INTO `etiquette_equipement` (idCategorieEtiquette,idEquipement,idAcronimeEtiquette) VALUES ('$categorie','$idequipement','$acronime')";
        $prep2 = $pdo->prepare($sql2);
        $prep2->execute();

         $sql3 = "INSERT INTO `fiche_de_vie` (idFicheDeVie,idEquipement) VALUES ('$idequipement','$idequipement')";
         $prep3 = $pdo->prepare($sql3);
         $prep3->execute();


        header('Location: ajout-element.php?succes');
    }

    else
        header('Location: ajout-element.php?erreur');
?>
