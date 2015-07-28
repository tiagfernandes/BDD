<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout.php', permet l'insersion du nouveau équipement dans la base
de donnée.
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
    $responsable = $_POST['responsable'];
    $variableAutomate = $_POST['variableAutomate'];
    $adresseAutomate = $_POST['adresseAutomate'];
    $idStoc = $_POST['idStoc'];
    $numFabrication = $_POST['nFabrication'];
    $attestationExamen = $_POST['attestationExamen'];
    $contratEntretien = $_POST['contratEntretien'];
    $suppleant = $_POST['suppleant'];
    $observation = $_POST['observation'];
    $fournisseur = $_POST['fournisseur'];

    if ($categorie!="NULL" && $acronime!="NULL" && $nom_equi!=NULL && $plateforme!=NULL){

        $sql = "INSERT INTO `equipement` (nomEquipement, prix, marque, dateAjout, garantie, dateFabrication, dateReception, dateMiseService,  idPlateforme, responsable, nomVariableAutomate, adresseAutomate, idStoc, nFabrication, attestationExamen, contratEntretien, suppleant, observation, idFournisseur) VALUES ('$nom_equi','$prix','$marque', NOW(), '$garantie', '$anneefb', '$dater', '$datemes', '$plateforme', '$responsable', '$variableAutomate', '$adresseAutomate', '$idStoc', '$numFabrication', '$attestationExamen', '$contratEntretien', '$suppleant', '$observation', '$fournisseur')";
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
