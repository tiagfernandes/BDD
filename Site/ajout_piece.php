<?php
    require_once('fonctions.php');


    $piece = $_GET['piece'];
    $val_piece = $_GET['val_piece'];


	//Vérification de la saisie de lieu d'archive


	if ((!empty($piece)) or (!empty($val_piece)) ){
		$sql = "INSERT INTO `piece_document` (pieceDocument, valeurPiece) VALUES ('$piece', '$val_piece')";
        $prep = $pdo->prepare($sql);
        $prep->execute();


        header('Location: ajout-archivage.php?succes_piece');
	}

	else{
    	header('Location: ajout-archivage.php?erreur');
	}
?>
