<?php
if(isset($_FILES['avatar']))
{
     $dossier = 'image/avatar/';
     $fichier = basename($_FILES['avatar']['name']);
     $image = 'image/avatar/'.$fichier.'';
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier))
     {
          header('Location: profil.php');
     }
     else
     {
          header('Location: profil.php?erreur');
     }
}
?>
