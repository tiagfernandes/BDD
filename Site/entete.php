<div id="entete">
        <script type="text/javascript" src="date_heure.js"></script>
       <?php require_once('information-utilisateur.php') ?>

        <div id="onglet">
            <ul id="nav">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="ajout-element.php">Ajout</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="admin.php">Administration</a></li>
           </ul>

        <div class="deco">
            <a href="logout.php" onclick="return(confirm('Etes-vous sûr de vouloir vous déconnectez ? '));">Déconnexion</a>
        </div>

        <div id="time">
            <span id="date_heure"></span>
            <script type="text/javascript">window.onload = date_heure('date_heure');</script>
        </div>


</div>
