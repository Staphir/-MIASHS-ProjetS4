<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");

$menu["title"] = "Mes histoires";
$dir1 = "../"; $dir2 = "../";
include("../main_header.php");
?>
<section style="margin-right:-40px;">
    <article class="card">
        <div>
            <h2>Rédiger une étape</h2><hr>
            <form action="save_step.php" method="post">
                <input type="hidden" name="id_story" value="<?php echo $_POST["id_story"] ?>">
                <textarea name="step" type="comment" id="step_area" cols="100" rows="14" placeholder="Ecrire ici la nouvelle étape" required></textarea>
                <!-- <input type="submit" name="end" value="Déclarer cette étape comme la dernière de l'histoire"> -->
        </div>
    </article>
</section>
<section style="margin-right:100px;">
    <article class="card">
        <div>   
                <h2>Ajouter des choix</h2><hr>             
                <div id="choix" style="background-color:transparent;">
                </div>
                <button type="button" class="ajt_chps" id="btn_ajout_champs" onclick="ajout_champ()">Ajouter un choix</button>
                <input type="submit" name="valid_step" value="Créer">
            </form>
        </div>
    </article>
</section>

<script type="text/javascript" src="script.js"></script>
<?php include("../footer.php"); ?>