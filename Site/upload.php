<?php
require_once('fonctions.php');

if(isset($_FILES['avatar']))
{
     $dossier = 'image/avatar/';
     $filename = basename($_FILES['avatar']['name']);
     $extension=strrchr($filename,'.');
     $image = 'image/avatar/'.$filename.'';

    if($extension!==FALSE){

        if(move_uploaded_file($_FILES["avatar"]["tmp_name"], $dossier .$_SESSION["nom"]."-".$_SESSION["prenom"] . $extension ))
            {
                $avatar = $_SESSION["nom"]."-".$_SESSION["prenom"] . $extension;
                $sql = "UPDATE utilisateur
                        SET image = :image";

                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(":image", $avatar);

                $stmt->execute();
                header('Location: profil.php');
            }
        else
            {
                header('Location: profil.php?erreur');
            }
    }

    else
        header('Location: profil.php?erreur');
}
?>
