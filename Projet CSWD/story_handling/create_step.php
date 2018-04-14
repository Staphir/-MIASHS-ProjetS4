<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");

$menu["title"] = "Mes histoires";
$dir2 = "../user_handling/";
include("../secondary_header.php");
?>

<div>
    <form action="save_step.php" method="post">
        <input type="hidden" name="id_story" value="<?php echo $_POST["id_story"] ?>">
        <textarea name="step" type="comment" id="step_area" cols="100" rows="20" placeholder="Nouvelle étape" required></textarea>
        <input type="submit" name="end" value="Déclarer cette étape comme la dernière de l'histoire">
        <hr class="choice"><div id="choix" style="background-color:transparent;">
        </div>
        <button type="button" id="btn_ajout_champs" onclick="ajout_champ()">Ajouter un choix</button>
        <hr class="choice"><input type="submit" name="valid_step" value="Créer">
    </form>
</div>

<script type="text/javascript" src="script.js"></script>
<?php include("../footer.php"); ?>