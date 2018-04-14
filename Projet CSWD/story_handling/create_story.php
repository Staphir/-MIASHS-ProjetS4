<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");
// require_once("../connect_database.php");
if(isset($_POST["story_name"]) && isset($_POST["story_description"])){
    $name = $_POST["story_name"];
    $description = $_POST["story_description"];
    $requete="INSERT INTO story (title, description, createdon, likes, lastmodifiedon, user_id, published) VALUES (?,?,NOW(),0,NOW(),?,0)";
    $reponse=$pdo->prepare($requete);
    $reponse->execute(array($name, $description, $_SESSION["user_id"]));
    header("location: ../story_handling/my_stories.php");
}
$menu["title"] = "Mes histoires"; $dir = "../user_handling/";

include("../secondary_header.php");

?>

<div>
    <form action="" method="post">
        Nom de l'histoire :<input type="text" name="story_name" required><br>
        Description :<textarea name="story_description" type="comment" cols="85" rows="10" required></textarea>
        <input type="submit" value="Créer">
    </form>
</div>
<?php include("../footer.php"); ?>