<?php
    session_start ();

if(isset($_FILES['avatar']))
{
     $dossier = 'image/avatar/';
     $filename = basename($_FILES['avatar']['name']);
     $extension=strrchr($filename,'.');
     $image = 'image/avatar/'.$filename.'';

    if($extension!==FALSE){

        if(move_uploaded_file($_FILES["avatar"]["tmp_name"], $dossier . $_SESSION["nom"] . $extension ))
            {
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
