<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");
include("../vendor/autoload.php");

$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'ISO-8859-1');
$config->set('Cache.DefinitionImpl', null); // TODO: remove this later!
$config->set('HTML.Allowed', $HTMLAllowed_Title);
$purifier = new HTMLPurifier($config);

if(isset($_POST["story_name"]) && isset($_POST["story_description"])){
    $name = $purifier->purify($_POST["story_name"]);
    
    $config = HTMLPurifier_Config::createDefault();
    $config->set('Core.Encoding', 'ISO-8859-1');
    $config->set('Cache.DefinitionImpl', null); // TODO: remove this later!
    $config->set('HTML.Allowed', $HTMLAllowed_Description);
    $purifier = new HTMLPurifier($config);

    $description = $purifier->purify($_POST["story_description"]);
    $requete="INSERT INTO story (title, description, createdon, likes, lastmodifiedon, user_id, published) VALUES (?,?,NOW(),0,NOW(),?,0)";
    $reponse=$pdo->prepare($requete);
    $reponse->execute(array($name, $description, $_SESSION["user_id"]));
    header("location: ../story_handling/my_stories.php");
}

$menu["title"] = "Mes histoires";
$dir1 = "../"; $dir2 = "../";
include("../main_header.php");

?>
<section>
    <article class="card">
        <div>
            <h2>Créer une histoire</h2><hr>
            <form method="post">
                <p>Nom de l'histoire :</p><input type="text" name="story_name" placeholder="..." required><br>
                <p>Description :</p><textarea name="story_description" placeholder="..." rows="5" required></textarea>
                <input type="submit" value="Créer">
            </form>
        </div>
    </article>
</section>
<?php include("../footer.php"); ?>