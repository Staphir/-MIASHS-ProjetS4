<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>
        Storystoire - Creation
    </title>
    <link href="css/style_create_story.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
    <header><h1>Création d'histoire</h1></header>

<form action="story_display.php" method="post">
    <textarea name="step" placeholder="Nouvelle étape"></textarea>
    <input type="submit" name="end" value="Fin de l'histoire">
    <ul id="choix">
        <li></li>
    </ul>
    <button type="button" id="btn_ajout_champs" onclick="ajout_champs()"/>
</form>
<script type="text/javascript" src="script.js"></script>
</body>
</html>