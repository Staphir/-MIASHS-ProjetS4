<?php
$menu["title"] = "Mes histoires";
$dir1 = "../"; $dir2 = "../";
include("../main_header.php");

if(!isset($_GET["story_id"]) or empty($_GET["story_id"])) {
    header("location: my_stories.php");
} else {
    $Id_story_choosed = $_GET["story_id"];

    $query="SELECT * FROM story WHERE story.id = ? AND user_id = ? ";
    $result=$pdo->prepare($query);
    $result->execute(array($Id_story_choosed, $_SESSION["user_id"]));
    $row = $result->fetchall(PDO::FETCH_ASSOC);

    if (empty($row)) {
        header("location: my_stories.php");
    } else {
        $query_first_step="SELECT * FROM step LEFT JOIN story ON step.id_story = story.id WHERE story.id = ? AND step.id_choice = 0 ";
        $response_first_step=$pdo->prepare($query_first_step);
        $response_first_step->execute(array($Id_story_choosed));
        $first_step = $response_first_step->fetchall(PDO::FETCH_ASSOC);
        // print_r($first_step);
?>
<section>
    <article class="card">
        <div>
            <?php echo "<h2 style='text_align:center;'>".$row[0]["title"]."</h2><hr>";

    if($first_step == NULL){
        ?>
        <form action="create_step.php" method="post">
            <input type="hidden" name="id_story" value="<?php echo $Id_story_choosed ?>">
            <input type="hidden" name="choice_parent" value="0">
            <input type="submit" name="new_step" value="Nouvelle étape">
        </form>
    <?php }else{
        $query_steps="SELECT * FROM step LEFT JOIN story ON step.id_story = story.id WHERE story.id = ? ";
        $response_steps=$pdo->prepare($query_steps);
        $response_steps->execute(array($Id_story_choosed));
        $table_steps = $response_steps->fetchall(PDO::FETCH_ASSOC);

        $query_choices="SELECT * FROM choice LEFT JOIN story ON choice.id_story = story.id WHERE story.id = ? ";
        $response_choices=$pdo->prepare($query_choices);
        $response_choices->execute(array($Id_story_choosed));
        $table_choices = $response_choices->fetchall(PDO::FETCH_ASSOC);

        //------------------------------------------------------------
        //affichage de l'arbre :

        //Test première étape :
        echo "<textarea id='treeEntry' hidden>".$table_steps[0]["content"]."\n ".$table_choices[0]["content"]."\n ".$table_choices[1]["content"];

        echo "</textarea>";

        //------------------------------------------------------------
    }
    ?>
    <?php
    include("../scripts_tree/tree_style.php");
    ?>
    <script src="../scripts_tree/treetodiagram.js"></script>
    <script src="../scripts_tree/layoutText.js"></script>
    <script src="../scripts_tree/gup.js"></script>
    <script src="../scripts_tree/texttotree.js"></script>
    <script src="../scripts_tree/demo.js"></script>
    </div>
    </article>
    </section>
    <?php
    include("../footer.php");
}
}
?>
