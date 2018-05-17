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

if ($step_or_choice == "Step"){
    //recuperation de l'etape
    $query_element="SELECT * FROM step WHERE id_story=? AND id=?;";
    $response_element=$pdo->prepare($query_element);
    $response_element->execute(array($id_story, $id));
    $array_step = $response_element->fetchAll(PDO::FETCH_ASSOC);
    //choix fils
    $query_choices="SELECT * FROM choice WHERE id_story=? AND id_step=?;";
    $response_choices=$pdo->prepare($query_choices);
    $response_choices->execute(array($id_story, $id));
    $choices_childs = $response_choices->fetchAll(PDO::FETCH_ASSOC);
}else {
    //recuperation choix
    $query_choices = "SELECT * FROM choice WHERE id_story=? AND id=?;";
    $response_choices = $pdo->prepare($query_choices);
    $response_choices->execute(array($id_story, $id));
    $array_choice = $response_choices->fetchAll(PDO::FETCH_ASSOC);
    //fille
    $query_steps="SELECT * FROM step WHERE id_story=? AND id_choice=?;";
    $response_steps=$pdo->prepare($query_steps);
    $response_steps->execute(array($id_story, $id));
    $steps_childs = $response_steps->fetchAll(PDO::FETCH_ASSOC);
    //si une etape fille
    if (!empty($steps_childs)){
        //step parent
        $query_element="SELECT * FROM step WHERE id_story=? AND id=?;";
        $response_element=$pdo->prepare($query_element);
        $response_element->execute(array($id_story, $parent));
        $array_step = $response_element->fetchAll(PDO::FETCH_ASSOC);
        //fils du step parent
        $query_choices="SELECT * FROM choice WHERE id_story=? AND id_step=?;";
        $response_choices=$pdo->prepare($query_choices);
        $response_choices->execute(array($id_story, $parent));
        $choices_childs = $response_choices->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
<style>
#textAreaDesc {
    resize: vertical;
    width: 100%;
    height: 100%; 
    box-sizing: border-box; 
    border: medium none;
    display: block;
}
#container {
    display: none;
}
div#choix, div#choix div {
    padding: 0px;
    margin: 0px;
}
.ajt_chps {

}
</style>
<script>
    var idStory = <?php echo json_encode($id_story); ?>;
</script>
    <section>
        <form action="save_step.php" method="post">
            <article class="card">
                <div>
                    <h2>Rédiger une étape <img id='editDescImg' style='margin-left:10px;' alt='Edit' src='../images/edit.png' width=25></h2><hr>
                    <input type="hidden" name="id_story" value="<?php echo $id_story ?>">
                    <?php if (!isset($array_step) || empty($array_step)){
                        ?>
                        <input type="hidden" name="parent" value="<?php echo $id ?>">
                        <input type="hidden" name="newStep" value="yes">
                        <div style='padding:0px;margin:0px;'>
                            <textarea id="textAreaDesc" cols="100" rows="14" placeholder="Ecrire ici la nouvelle étape..." name="step"></textarea>
                            <div id='container' style='padding:0px;margin:0px;'></div>
                        </div>
                        <!-- <textarea name="step" id="step_area" cols="100" rows="14" placeholder="Ecrire ici la nouvelle étape" required></textarea> -->
                        <input type="hidden" id="nb_choix" name="nb_choix" value="0">
                        <?php
                    }else{
                        ?>
                        <input type="hidden" name="parent" value="<?php echo $array_step[0]["id_choice"]; ?>">
                        <input type="hidden" name="newStep" value="no">
                        <input type="hidden" name="stepId" value="<?php echo $array_step[0]["id"]; ?>">
                        <div style='padding:0px;margin:0px;'>
                            <textarea id="textAreaDesc" cols="100" rows="14" placeholder="Ecrire ici la nouvelle étape..." name="step"><?php echo $array_step[0]["content"]; ?></textarea>
                            <div id='container' style='padding:0px;margin:0px;'></div>
                        </div>
                        <!-- <textarea name="step" id="step_area" cols="100" rows="14" required><?php echo $array_step[0]["content"]; ?></textarea> -->
                        <input type="hidden" id="nb_choix" name="nb_choix" value="0">
                        <?php
                    }
                    ?>
                </div>
            </article>
            <article class="card">
                <div>
                    <h2>Ajouter des choix</h2><hr>
                    <div id="choix" style="background-color:transparent;padding-left:30px;">
                    </div>
                    <button type="button" class="ajt_chps" id="btn_ajout_champs" onclick="ajout_champ(null)" style='text-decoration:underline;background-color:transparent;width:auto;border:none;color:grey;cursor:pointer'>Ajouter un choix</button>
                    <input type="submit" name="valid_step" value="Créer / Modifier">
                </div>
            </article>
        </form>
    </section>
    <script src="script.js"></script>
    <?php
    if (isset($array_step)) {
        $_SESSION['choices_modified'] = $choices_childs;
        for ($i = 0; $i < count($choices_childs); $i++) {
            ?>
            <script type='text/javascript'> ajout_champ_enfant(<?php echo json_encode($choices_childs[$i]["content"]).",". json_encode($choices_childs[$i]["id"]); ?>); </script>
            <?php
        }
    }
    include("../footer.php"); ?>