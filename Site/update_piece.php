<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_piece.php', modifie la piece choisis.
---------------------------------------------------------------------------
L'utilisateur :
N'est pas autorisé.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');


	$sql = "UPDATE piece_document
            SET valeurPiece = :valeurPiece,
            pieceDocument = :piece
			WHERE idPiece_Document = :idPiece
			";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':valeurPiece', $_POST['valeurPiece'], PDO::PARAM_STR);
    $stmt->bindValue(':piece', $_POST['piece'], PDO::PARAM_STR);
    $stmt->bindValue(':idPiece', $_GET['idPiece'], PDO::PARAM_STR);

    $stmt->execute();

    header ('location: ajout-archivage.php?succes_update');
?>
