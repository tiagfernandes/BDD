<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'a-anomalie.php', permet l'insersion d'une nouvelle anomalie a un
équipement.
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
    $datedebut = $_POST['datedano'];
    $datefin = $_POST['datefano'];
    $nom="Anomalie";

    if (!empty($description) && !empty($datedebut)){

        $sql = "INSERT INTO `anomalie` (nomAnomalie, dateAnomalie, finAnomalie, description, idUtilisateur) VALUES ('$nom', '$datedebut', '$datefin', '$description', '".$_SESSION['idUtilisateur']."')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        $idAnomalie =$pdo->lastInsertId();

         $sql2 = "INSERT INTO `fiche_de_vie_has_anomalie` (idAnomalie, idFicheDeVie) VALUES ('$idAnomalie', '$idEquipement')";
         $prep2 = $pdo->prepare($sql2);
         $prep2->execute();

        header('Location: fiche-vie.php?idEquipement='.$idEquipement.'&anomalie=succes');
    }

    else
        header('Location: ajout-anomalie.php?idEquipement='.$idEquipement.'&anomalie=erreur');

?>
