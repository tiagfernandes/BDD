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

        <form method="post" action="ajout.php">

            <label id="ajout_element">Nom équipement : </label><input type="text" name="nom_equipement" placeholder="Nom"></p>

            <label id="ajout_element">Etiquette : </label></p>
                <select name="plateforme">
                    <option value=NULL>-- Plateforme --</option>
                    <option value="Serre">Serre</option>
                    <option value="Eco">Eco</option>
                    <option value="Plan">Plan</option>
                    <option value="ML">ML</option>
                    <option value="Vol">Vol</option>
                </select> -
                <select name="piece">
                    <option value=NULL>-- Pièce --</option>
                    <option value="BC">BC</option>
                    <option value="BE">BE</option>
                    <option value="BS">BS</option>
                    <option value="LC">LC</option>
                    <option value="LCh">LCh</option>
                    <option value="LH">LH</option>
                    <option value="LM">LM</option>
                    <option value="Lav">Lav</option>
                    <option value="LL">LL</option>
                    <option value="LP">LP</option>
                 </select> -
                <input type="text" name="emplacement" placeholder="Emplacement"></p>
            <label id="ajout_element">Prix : </label><input type="text" name="prix" placeholder="Prix"></p>
            <label id="ajout_element">Marque : </label><input type="text" name="marque" placeholder="Marque"></p>
            <label id="ajout_element">Année de fabrication : </label><input type="text" name="anneefb" placeholder="Année Fabrication"></p>
            <label id="ajout_element">Date mise en service : </label><input type="text" name="datemes" placeholder="Date Mise en service"></p>
            <label id="ajout_element">Durée garantie : </label><input type="text" name="garantie" placeholder="Durée garantie"></p>
            <label id="ajout_element">Type : </label><input type="text" name="type" placeholder="Type">
            <div id ="msg">
             <?php
                $monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                if ($monUrl == "http://localhost/BDD/Site/ajout-element.php?erreur"){
                    echo ("Veuilliez saisir tous les champs ");
                }
            ?>
            </div>
            </p><input class="button" type="submit" value="Ajouter">
          </form>
          </div>
        </fieldset>
        </div>
    </body>
</html>
