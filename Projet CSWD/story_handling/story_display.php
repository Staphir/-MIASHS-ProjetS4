<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");
// require_once("../connect_database.php");

// ATTENTION :
// Je pense retirer le $_GET["story_title"] et uniquement se servir de l'id
// de l'histoire pour aussi récupérer le titre. Avec la méthode GET tu as
// introduit une faille de sécurité.
// Es-tu un agent double ? -_-
// J'ai corrigé la faille et mis la condition suivante : si le user_id
// associé à l'id de l'histoire n'est pas celui de la session ouverte
// alors on renvoit vers my_stories.php

// Et j'ai remplacé le secondary_header.php par le main_header.php
// C'est mieux

if(isset($_GET["story_id"]) && isset($_GET["story_title"])) {
    $Id_story_choosed = $_GET["story_id"];
    // $Title_story_choosed = $_GET["story_title"];
} else {
    header("location: my_stories.php");
}
// print_r($_SESSION);
$query="SELECT * FROM story INNER JOIN user ON story.user_id = user.id WHERE story.id = ? AND user.id = ? ";
$result=$pdo->prepare($query);
$result->execute(array($Id_story_choosed, $_SESSION["user_id"]));
$row = $result->fetchall(PDO::FETCH_ASSOC);

if (empty($row)) {
    header("location: my_stories.php");
} else {
    $menu["title"] = "Mes histoires";
    $dir1 = "../"; $dir2 = "../";
    include("../main_header.php");

    $query_first_step="SELECT * FROM step LEFT JOIN story ON step.id_story = story.id WHERE story.id = ? AND step.id_choice = 0 ";
    $response_first_step=$pdo->prepare($query_first_step);
    $response_first_step->execute(array($Id_story_choosed));
    $first_step = $response_first_step->fetchall(PDO::FETCH_ASSOC);
    // print_r($first_step);
?>
<section style="margin-right:100px;">
    <article class="card">
        <div>
            <?php echo "<h2 style='text_align:center;'>".$row[0]["title"]."</h2><hr>";

        if($first_step == NULL){
        ?>
        <form action="create_step.php" method="post">
            <input type="hidden" name="id_story" value="<?php echo $Id_story_choosed ?>">
            <input type="submit" name="new_step" value="Nouvelle étape">
        </form>
    <?php } ?>
        </div>
    </article>
</section>

    <?php
    include("../footer.php");
}
?>
