<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_type.php', modification du type.
---------------------------------------------------------------------------
L'utilisateur :
N'est pas autorisé.
---------------------------------------------------------------------------
Le développeur :
N'est pas autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');


	$sql = "UPDATE type_document
            SET valeurTypeDoc = :valeurType,
            typeDocument = :type
			WHERE idType_Document = :idType
			";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':valeurType', $_POST['valeurType'], PDO::PARAM_STR);
    $stmt->bindValue(':type', $_POST['type'], PDO::PARAM_STR);
    $stmt->bindValue(':idType', $_GET['idType'], PDO::PARAM_STR);

    $stmt->execute();

    header ('location: ajout-etiquette_doc.php');
?>
