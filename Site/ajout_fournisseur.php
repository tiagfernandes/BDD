<?php
/* ------------------------------------------------------------------------
Crée le 28/07/2015.
Modifiée le 28/07/2015 par Fernandes Tiago
---------------------------------------------------------------------------
Page 'ajout_fournisseur.php', permet l'insersion d'un nouveau fournisseur.
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

    $nomFournisseur = $_POST['nomFournisseur'];
    $adresse = $_POST['adresse'];
    $codePostal = $_POST['codePostal'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];

    if (!empty($nomFournisseur)){

        $sql = "INSERT INTO `fournisseur` (nomFournisseur, adresse, cp, ville, pays, telephone, email) VALUES 	('$nomFournisseur', '$adresse', '$codePostal', '$ville', '$pays', '$tel', '$email')";
        $prep = $pdo->prepare($sql);
        $prep->execute();

        header('Location: ajout-fournisseur.php?succes');
    }

    else
        header('Location: ajout-fournisseur.php?erreur');
?>
