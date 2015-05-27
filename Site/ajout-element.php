<?php
    require_once('fonctions.php');

    session_start ();
?>

<!doctype html>
<html lang="fr">
<meta charset="UTF-8">

   <head>
    <title>Index</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>


   <body>

    <?php require_once('entete.php'); ?>
        <div id="contenu">
         <div id="banniere">
              Ajout d'un équipement
          </div>
          <div id="form-ajout"><fieldset>
               <legend>Fiche équipement</legend>
          <form method="post" action="">

            <label>Nom équipement : </label><input type="text" name="nom_equipement" placeholder="Nom"></p>
            <label>Etiquette : </label></p>
            <select name="palteforme">
                <option value=0>-- Plateforme --</option>
                <option value="">Serre</option>
                <option value="">Eco</option>
                <option value="">Plan</option>
                <option value="">ML</option>
                <option value="">Vol</option>
             </select>
             <select name="piece">
                <option value=0>-- Pièce --</option>
                <option value="">BC</option>
                <option value="">BE</option>
                <option value="">BS</option>
                <option value="">LC</option>
                <option value="">LCh</option>
                <option value="">LH</option>
                <option value="">LM</option>
                <option value="">Lav</option>
                <option value="">LL</option>
                <option value="">LP</option>
             </select>
            <input type="text" name="emplacement" placeholder="Emplacement">
            </p><label>Prix : </label><input type="text" name="price" placeholder="Prix">
            </p><label>Marque : </label><input type="text" name="marque" placeholder="Marque">
            </p><label>Année de fabrication : </label><input type="text" name="anneefb" placeholder="Année Fabrication">
            </p><label>Date mise en service : </label><input type="text" name="datemes" placeholder="Date Mise en service">
            </p><label>Durée garantie : </label><input type="text" name="garantie" placeholder="Durée garantie">
            </p><label>Type : </label><input type="text" name="type" placeholder="Type">
            </p><input class="button" type="submit" value="Ajouter">
          </form>
          </div>
        </fieldset>
        </div>
    </body>
</html>
