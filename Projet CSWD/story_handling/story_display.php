<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");
// require_once("../connect_database.php");

if(isset($_GET["story_id"])) {
    $Id_story_choosed = $_GET["story_id"];
}
if(isset($_GET["story_title"])){
    $Title_story_choosed = $_GET["story_title"];
}
$menu["title"] = "Mes histoires"; $dir = "../user_handling/";

include("../secondary_header.php");

$query_first_step="SELECT * FROM step LEFT JOIN story ON step.id_story = story.id WHERE story.id='$Id_story_choosed' AND step.id_choice IS NULL ";
$response_first_step=$pdo->prepare($query_first_step);
$response_first_step->execute();
$first_step = $response_first_step->fetchall();
print_r($first_step);



    echo "<h1 style='text-align: center'>".$Title_story_choosed."</h1>";

if($first_step == NULL){
    ?>
    <form action="create_step.php" method="post">
        <input type="hidden" name="id_story" value="<?php echo $Id_story_choosed ?>">
        <input type="submit" name="new_step" value="Nouvelle étape">
    </form>
    <?php
}
    ?>
<?php include("../footer.php"); ?>