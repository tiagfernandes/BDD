<?php
    require_once('fonctions.php');


    $plateforme = $_POST['plateforme'];
    $val_plateforme = $_POST['val_plateforme'];
    $piece = $_POST['piece'];
    $val_piece = $_POST['val_piece'];
    $emplacement = $_POST['emplacement'];
    $val_emplacement = $_POST['val_emplacement'];
    $s_emplacement = $_POST['s_emplacement'];
    $val_s_emplacement = $_POST['val_s_emplacement'];

	//Vérification de la saisie de lieu d'archive

    if ((!empty($plateforme)) or (!empty($val_plateforme))){

        $sql = "INSERT INTO `plateforme_archive` (plateformeArchive, valeurPlateforme) VALUES ('$plateforme', '$val_plateforme')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-archivage.php?succes_platforme');
    }

	else if ((!empty($piece)) or (!empty($val_piece)) ){
		$sql = "INSERT INTO `piece_archive` (pieceDocument, valeurPiece) VALUES ('$piece', '$val_piece')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-archivage.php?succes_piece');
	}

	else if ((!empty($emplacement)) or (!empty($val_emplacement))){
		$sql = "INSERT INTO `emplacement_archive` (emplacementArchive, valeurEmplacement) VALUES ('$emplacement', '$val_emplacement')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-archivage.php?succes_emplacement');
	}

	else if ((!empty($s_emplacement)) or (!empty($val_s_emplacement))){
		$sql = "INSERT INTO `sous_emplacement` (sousEmplacement, valeurSousEmplacement) VALUES ('$s_emplacement', '$val_s_emplacement')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-archivage.php?succes_s_emplacement');
	}

	else{
    	header('Location: ajout-archivage.php?erreur');
	}
?>
