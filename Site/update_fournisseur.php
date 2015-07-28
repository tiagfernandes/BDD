<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'update_fournisseur.php', modifie le fournisseur choisis.
---------------------------------------------------------------------------
L'utilisateur :
Autorisé.
---------------------------------------------------------------------------
Le développeur :
Autorisé.
---------------------------------------------------------------------------
L'administrateur :
Autorisé.
------------------------------------------------------------------------ */

    require_once('fonctions.php');


	$sql = "UPDATE fournisseur
            SET nomFournisseur = :nom,
            adresse = :adresse,
            cp = :cp,
            ville = :ville,
            pays = :pays,
            telephone = :tel,
            email = :email
			WHERE idFournisseur = :idFournisseur
			";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':nom', $_POST['nomFournisseur'], PDO::PARAM_STR);
    $stmt->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
    $stmt->bindValue(':cp', $_POST['cp'], PDO::PARAM_STR);
    $stmt->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
    $stmt->bindValue(':pays', $_POST['pays'], PDO::PARAM_STR);
    $stmt->bindValue(':tel', $_POST['tel'], PDO::PARAM_STR);
    $stmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->bindValue(':idFournisseur', $_GET['idFournisseur'], PDO::PARAM_STR);

    $stmt->execute();

    header ('location: ajout-fournisseur.php?succes_update');
?>
