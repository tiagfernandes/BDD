<?php
    require_once('fonctions.php');

?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Document lié</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


   <body>

    <?php require_once('entete.php'); ?>
    	<?php if ($_SESSION['role']== "Administrateur") {?>
        	<div id="contenu">
           		<div id="banniere">Ajout d'un document lié</div>

        	</div>

        <?php }
            else{
                $message="Vous devez être Administrateur pour acceder à cette page !";
                	echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
                header('refresh:0.01;url=index.php');
            }
        ?>
    </body>
</html>
