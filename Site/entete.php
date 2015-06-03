<html>
    <head>
        <script language="Javascript">
            var timeout	= 500;
            var closetimer	= 0;
            var ddmenuitem	= 0;

            // open hidden layer
            function mopen(id)
            {
                // cancel close timer
                mcancelclosetime();

                // close old layer
                if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';

                // get new layer and show it
                ddmenuitem = document.getElementById(id);
                ddmenuitem.style.visibility = 'visible';

            }
            // close showed layer
            function mclose()
            {
                if(ddmenuitem) ddmenuitem.style.visibility = 'hidden';
            }

            // go close timer
            function mclosetime()
            {
                closetimer = window.setTimeout(mclose, timeout);
            }

            // cancel close timer
            function mcancelclosetime()
            {
                if(closetimer)
                {
                    window.clearTimeout(closetimer);
                    closetimer = null;
                }
            }

            // close layer when click-out
            document.onclick = mclose;
        </script>
    </head>
<nav id="entete">
        <script type="text/javascript" src="date_heure.js"></script>
       <?php require_once('information-utilisateur.php') ?>
        <div id="onglet">
        <div id="time">
            <span id="date_heure"></span>
            <script type="text/javascript">window.onload = date_heure('date_heure');</script>
        </div>
        <div class="deco">
            <a href="logout.php" onclick="return(confirm('Etes-vous sûr de vouloir vous déconnectez ? '));">Déconnexion</a>
        </div>
        <ul id="sddm">
            <li><a href="index.php">Accueil</a>
            </li>
            <li><a href="#"
                onmouseover="mopen('m2')"
                onmouseout="mclosetime()">Ajout</a>
                <div id="m2"
                    onmouseover="mcancelclosetime()"
                    onmouseout="mclosetime()">
                <a href="ajout-element.php">Equipement</a>
                <a href="ajout-document.php">Document</a>
                </div>
            </li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="admin.php">Admin</a></li>
        </ul>
        <div style="clear:both"></div>
</nav>
</html>
