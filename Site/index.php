<!doctype html>
<html lang="fr">

   <head>
    <title>Index</title>
    <link rel="shortcut icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="icon" type="image/x-icon" href="./image/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <body>
        <div id="contenu">
            <form action="form.php" method="post">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" />
            </div>
            <div>
                <label for="courriel">Courriel :</label>
                <input type="email" id="courriel" />
            </div>
            <div>
                <label for="message">Message :</label>
                <textarea id="message"></textarea>
            </div>
            <div class="button">
                <button type="submit">Envoyer votre message</button>
            </div>
            </form>
        </div>
    </body>
</html>
