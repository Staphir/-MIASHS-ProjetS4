<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");

$menu["title"] = "Création";
$dir1 = "../"; $dir2 = "../";
include("../main_header.php");

//vérifier si parent récup a un fils :
//non : création d'une étape
//oui : edition d'une étape
?>
<form action="save_step.php" method="post">
    <section>
        <article class="card">
            <div>
                <h2>Rédiger une étape</h2><hr>
                <input type="hidden" name="id_story" value="<?php echo $_POST["id_story"] ?>">
                <input type="hidden" name="parent" value="<?php echo $_POST["parent"] ?>">
                <input type="hidden" id="nb_choix" name="nb_choix" value="0">
                <textarea name="step" type="comment" id="step_area" cols="100" rows="14" placeholder="Ecrire ici la nouvelle étape" required></textarea>
            </div>
        </article>
        <article class="card">
            <div>
                <h2>Ajouter des choix</h2><hr>
                <div id="choix" style="background-color:transparent;">
                </div>
                <button type="button" class="ajt_chps" id="btn_ajout_champs" onclick="ajout_champ()">Ajouter un choix</button>
                <input type="submit" name="valid_step" value="Créer">
            </div>
        </article>
    </section>
</form>
<script type="text/javascript" src="script.js"></script>
<?php include("../footer.php"); ?>