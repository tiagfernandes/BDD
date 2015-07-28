<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_categorie.php', modifie la categorie choisis.
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


	$sql = "UPDATE categorie_etiquette
            SET valeurCategorie = :valCategorie,
            categorieEtiquette = :categorie
			WHERE idCategorieEtiquette = :idCategorie
			";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':valCategorie', $_POST['valCategorie'], PDO::PARAM_STR);
    $stmt->bindValue(':categorie', $_POST['categorie'], PDO::PARAM_STR);
    $stmt->bindValue(':idCategorie', $_GET['idCategorie'], PDO::PARAM_STR);

    $stmt->execute();

    header ('location: ajout-categorie.php?succes_update');
?>
