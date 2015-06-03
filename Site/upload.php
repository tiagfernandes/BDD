<?php
if(isset($_FILES['avatar']))
{
     $dossier = 'image/';
     $fichier = basename($_FILES['avatar']['name']);
     $image = 'image/'.$fichier.'';
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier))
     {
          header ('location: profil.php');
     }
     else
     {
          header('Location: profil.php?erreur');
     }
}
?>
