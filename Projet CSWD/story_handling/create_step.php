<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");

$menu["title"] = "Création";
$dir1 = "../"; $dir2 = "../";
include("../main_header.php");

$step_or_choice = $_POST["step_or_choice"];
$id_story = $_POST["id_story"];
$parent = $_POST["parent"];
$id = $_POST["id"];

$query_choices="SELECT * FROM choice WHERE id_story=? AND id_step=?;";
$response_choices=$pdo->prepare($query_choices);
$response_choices->execute(array($id_story, $id));
$choices_childs = $response_choices->fetchAll(PDO::FETCH_ASSOC);

$query_steps="SELECT * FROM step WHERE id_story=? AND id_choice=?;";
$response_steps=$pdo->prepare($query_steps);
$response_steps->execute(array($id_story, $id));
$steps_childs = $response_steps->fetchAll(PDO::FETCH_ASSOC);

if ($step_or_choice == "Step"){
    $query_element="SELECT * FROM step WHERE id_story=? AND id=?;";
    $response_element=$pdo->prepare($query_element);
    $response_element->execute(array($id_story, $id));
    $array_step = $response_element->fetchAll(PDO::FETCH_ASSOC);
}

?>
    
    <section>
        <form action="save_step.php" method="post">
            <article class="card">
                <div>
                    <h2>Rédiger une étape</h2><hr>
                    <input type="hidden" name="id_story" value="<?php echo $id_story ?>">
                    <input type="hidden" name="parent" value="<?php echo $parent ?>">
                    <?php if (($step_or_choice == "Choice" && $choices_childs == null) || $parent == 0){
                        ?>
                        <textarea name="step" type="comment" id="step_area" cols="100" rows="14" placeholder="Ecrire ici la nouvelle étape" required></textarea>
                        <input type="hidden" id="nb_choix" name="nb_choix" value="0">
                        <?php
                    }else{
                        ?>
                        <textarea name="step" type="comment" id="step_area" cols="100" rows="14" placeholder="<?php echo $array_step[0]["content"]; ?>" required></textarea>
                        <input type="hidden" id="nb_choix" name="nb_choix" value="0">
                        <?php
                    }
                    ?>
                </div>
            </article>
            <article class="card">
                <div>
                    <h2>Ajouter des choix</h2><hr>
                    <div id="choix" style="background-color:transparent;">
                    </div>
                    <button type="button" class="ajt_chps" id="btn_ajout_champs" onclick="ajout_champ()">Ajouter un choix</button>
                    <input type="button" name="valid_step" value="Créer - Ne fonctionne pas encore">
                </div>
            </article>
        </form>
    </section>
    <script type="text/javascript" src="script.js"></script>
    <?php
    if ($step_or_choice == "Step" && $steps_childs != null) {
        for ($i = 0; $i < count($choices_childs); $i++) {
            ?>
            <script type='text/javascript'> ajout_champ_enfant(<?php echo $choices_childs[$i]["content"]; ?>); </script>
            <?php
        }
    }
    include("../footer.php"); ?>