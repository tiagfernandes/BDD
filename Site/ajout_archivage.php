<?php
    require_once('fonctions.php');


    $plateforme = $_POST['plateforme'];
    $piece = $_POST['piece'];
    $emplacement = $_POST['emplacement'];
    $s_emplacement = $_POST['s_emplacement'];

	//Vérification de la saisie de lieu d'archive

    if (!empty($plateforme)){

        $sql = "INSERT INTO `plateforme_archive` (plateformeArchive) VALUES ('$plateforme')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-archivage.php?succes_platforme');
    }

	else if (!empty($piece)){
		$sql = "INSERT INTO `piece_archive` (pieceDocument) VALUES ('$piece')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-archivage.php?succes_piece');
	}

	else if (!empty($emplacement)){
		$sql = "INSERT INTO `emplacement_archive` (emplacementArchive) VALUES ('$emplacement')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-archivage.php?succes_emplacement');
	}

	else if (!empty($s_emplacement)){
		$sql = "INSERT INTO `sous_emplacement` (sousEmplacement) VALUES ('$s_emplacement')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-archivage.php?succes_s_emplacement');
	}

	else{
    	header('Location: ajout-archivage.php?erreur');
	}
?>
