<div id="entete">
        <script type="text/javascript" src="date_heure.js"></script>
       <?php require_once('information-utilisateur.php') ?>
        <div class="bouton">
            <a href="logout.php" onclick="return(confirm('Etes-vous sûr de vouloir vous déconnectez ? '));">Déconnexion</a>
        </div>
            <a href="index.php">Accueil</a> |
            <a href="ajout-element.php">Ajout équipement</a> |
            <a href="profil.php">Profil</a> |
            <a href="admin.php">Admin</a>
        <div id="time">
            <span id="date_heure"></span>
            <script type="text/javascript">window.onload = date_heure('date_heure');</script>
        </div>
</div>
