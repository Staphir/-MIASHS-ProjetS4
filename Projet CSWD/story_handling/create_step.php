<?php
$menu["title"] = "Mes histoires"; $dir = "../user_handling/";

include("../secondary_header.php");
?>

<div>
    <form action="save_step.php" method="post">
        <input type="hidden" name="id_story" value="<?php echo $_POST["id_story"] ?>">
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
<?php include("../footer.php"); ?>