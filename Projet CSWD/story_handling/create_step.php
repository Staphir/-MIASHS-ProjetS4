<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>
        Storystoire - Creation
    </title>
    <link href="style_create_story.css" rel="stylesheet" type="text/css" media="all">
</head>
<body>
<header><h1>Création d'histoire</h1></header>

<div>
    <form action="story_display.php" method="post">
        <textarea name="step" id="step_area" cols="100" rows="20" placeholder="Nouvelle étape" required></textarea>
        <input type="submit" name="end" value="Fin de l'histoire">
        <ul id="choix">
        </ul>
        <button type="button" id="btn_ajout_champs" onclick="ajout_champ()">+</button>
        <button type="button" id="btn_supp_champs" onclick="supp_champ()">x</button>
        <input type="submit" name="valid_step" value="Créer">
    </form>
</div>

<script type="text/javascript" src="script.js"></script>
</body>
</html>