<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout_piece.php', permet l'insersion d'une nouvelle pièce.
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


    $piece = $_GET['piece'];
    $val_piece = $_GET['val_piece'];


	//Vérification de la saisie de lieu d'archive


	if ((!empty($piece)) or (!empty($val_piece)) ) {

		$sql = "INSERT INTO `piece_document` (pieceDocument, valeurPiece) VALUES ('$piece', '$val_piece')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        header('Location: ajout-archivage.php?succes_piece');
	}

	else{
    	header('Location: ajout-archivage.php?erreur');
	}
?>
