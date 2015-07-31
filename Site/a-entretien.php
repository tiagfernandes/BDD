<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'a-entretien.php', permet l'insersion d'un nouveau entretien a
un équipement.
---------------------------------------------------------------------------
L'utilisateur :
Ne peut rien faire.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');

	$idEquipement = $_GET['idEquipement'];

    $description = $_POST['description'];
    $dateentretien = $_POST['dateentretien'];

	$nom = "Entretien";

    if (!empty($description) && !empty($dateentretien)){

        $sql = "INSERT INTO `entretien` (nomEntretien, dateEntretien, description, idUtilisateur) VALUES ('$nom', '$dateentretien', '$description', '".$_SESSION['idUtilisateur']."')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $idEntretien =$pdo->lastInsertId();

         $sql2 = "INSERT INTO `fiche_de_vie_has_entretien` (idEntretien, idFicheDeVie) VALUES ('$idEntretien', '$idEquipement')";
         $prep2 = $pdo->prepare($sql2);
         $prep2->execute();

        header('Location: fiche-vie.php?idEquipement='.$idEquipement.'&entretien=succes');
    }

    else
        header('Location: fiche-vie.php?idEquipement='.$idEquipement.'&entretien=erreur');

?>
